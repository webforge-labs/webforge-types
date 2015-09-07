<?php

namespace Webforge\Types;

class TypeTest extends \Webforge\Code\Test\Base {
  
  public function setUp() {
    $this->chainClass = __NAMESPACE__ . '\\Type';
    parent::setUp();

    $this->type = new CustomStringType();
  }

  public function testTypeHasANameWithoutTypeAtTheEnd() {
    $this->assertEquals('CustomString', $this->type->getName());
  }

  public function testCreatesAFlyWeightWithJustTypeName() {
    $type = Type::create('CustomString');
    $this->assertInstanceOf('Webforge\Types\CustomStringType', $type);
    $this->assertEquals('CustomString',$type->getName());

    $this->assertNotSame($this->type,$type);
  }

  public function testTypeHasACreateFunctionAsSelfFactory() {
    $type = CustomStringType::create();
    $this->assertInstanceOf('Webforge\Types\CustomStringType', $type);
    $this->assertEquals('CustomString',$type->getName());
  }
   
  public function testTypeCannotBeCreatedWithoutArgument() { 
    $this->setExpectedException('Webforge\Types\Exception');

    Type::create();
  }
  
  public function testArgsCreation_withEmptyArgs() {
    $arrayType = Type::createArgs('Array', array());
    $arrayType = Type::createArgs('Array', array($innerType = Type::create('String')));

    $this->assertSame($arrayType->getType(), $innerType);
  }
  
  public function testObjectsCanBeCratedWithStrings() {
    $objectExceptionType = Type::create('Object<Webforge\Types\Exception>');
    $this->assertInstanceOf('Webforge\Types\ObjectType', $objectExceptionType);
    $this->assertEquals('Webforge\Types\Exception', $objectExceptionType->getGClass()->getFQN());
  }

  public function testArraysCanBeConstructedWithBrackets() {
    $stringArrayType = Type::create('String[]');
    $this->assertInstanceOf('Webforge\Types\ArrayType', $stringArrayType);
    $this->assertEquals('String', $stringArrayType->getType()->getName());
  }

  public function testArrayAndObjectsCanBeNested() {
    $arrayType = Type::create('Object<Webforge\Types\Exception>[]');
    $this->assertInstanceOf('Webforge\Types\ArrayType', $arrayType);
    $this->assertInstanceOf('Webforge\Types\ObjectType', $objectType = $arrayType->getType());
    $this->assertEquals('Webforge\Types\Exception', $objectType->getGClass()->getFQN());
  }

  public function testCreationFromEnumTypes() {
    require_once __DIR__.'/../../Labeler-Polyfill.php';

    $enumType = Type::create('Enum<tiptoi\SoundLanguageType>');
    $this->assertInstanceOf('Webforge\Types\DCEnumType', $enumType);
    $this->assertEquals('tiptoi\SoundLanguageType', $enumType->getClass()->getFQN());
  }
  
  /**
   * @dataProvider docBlockTypes
   */
  public function testDocBlockParsing($expectedTypeFQN, $docBlockWord) {
    $this->assertInstanceof($expectedTypeFQN, Type::parseFromDocBlock($docBlockWord));
  }
  
  public static function docBlockTypes() {
    $tests = array();
    $t = function ($name) {
      return 'Webforge\Types\\'.$name.'Type';
    };
    
    $tests[] = array(
      $t('Integer'),
      'integer'
    );

    $tests[] = array(
      $t('String'),
      'string'
    );

    $tests[] = array(
      $t('Mixed'),
      'mixed'
    );

    $tests[] = array(
      $t('Boolean'),
      'bool'
    );

    $tests[] = array(
      $t('Boolean'),
      'boolean'
    );

    $tests[] = array(
      $t('Object'),
      'stdClass'
    );

    $tests[] = array(
      $t('Object'),
      'object'
    );

    $tests[] = array(
      $t('Array'),
      'array'
    );

    $tests[] = array(
      $t('Array'),
      'string[]'
    );

    $tests[] = array(
      $t('Array'),
      'integer[]'
    );

    $tests[] = array(
      $t('String'),
      'string in MD5 gehashed'
    );
    
    return $tests;
  }
}

class CustomStringType extends Type {
  
}
