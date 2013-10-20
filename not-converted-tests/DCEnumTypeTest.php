<?php

namespace Webforge\Types;

class DCEnumTypeTest extends \Webforge\Types\Test\TestCase {
  
  protected $dCEnumType;
  protected $gClass;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\DCEnumType';
    parent::setUp();
    
    $this->gClass = GClassAdapter::newGClass('EnumTestType');
    $this->gClass->setNamespace(__NAMESPACE__);
    $this->enumType = new DCEnumType($this->gClass);

    $this->enumType->getLabeler()
      ->label(EnumTestType::MAN, 'label:Mann')
      ->label(EnumTestType::WOMAN, 'label:Frau')
      ->label(EnumTestType::MAIN, 'label:Hauptsprecher')
    ;
  }
  
  public function testRegisterType() {
    \Doctrine\DBAL\Types\Type::addType('test_speakerType', $this->gClass->getFQN());
  }
  
  public function testAcceptance() {
    $this->assertInstanceOf('Psc\Doctrine\ExportableType', $this->enumType);
    $this->assertEquals('test_speakerType', $this->enumType->getDoctrineExportType());
    
    $this->assertInstanceOf('Webforge\Types\ValidationType', $this->enumType);
    $this->assertInstanceOf('Psc\Form\ValuesValidatorRule', $rule = $this->enumType->getValidatorRule(new TypeRuleMapper()));
    
    $this->assertEquals('Webforge\Types\EnumTestType', $this->enumType->getDocType());
    
    $rule->validate(EnumTestType::MAIN);
    $rule->validate(EnumTestType::MAN);
    $rule->validate(EnumTestType::WOMAN);
  }
  
  public function testComponentMapping() {
    $radios = $this->assertTypeMapsComponent('Radios', $this->enumType);
    
    $values = $radios->getValues();
    
    $this->assertEquals(array(EnumTestType::MAIN, EnumTestType::MAN, EnumTestType::WOMAN), array_keys($values));
    $this->assertEquals(array('label:Hauptsprecher', 'label:Mann', 'label:Frau'), array_values($values));
  }
  
  public function testCodeExport() {
    $this->assertCodeExportEquals($this->enumType);
  }
}

class EnumTestType extends \Psc\Doctrine\EnumType {
  
  const MAIN = 'Hauptsprecher'; 
  const MAN = 'Mann';   
  const WOMAN = 'Frau';

  protected $name = 'test_speakerType';
  protected $values = array(self::MAIN, self::MAN, self::WOMAN);
  
  public static function instance() {
    return self::getType('test_speakerType');
  }
}
