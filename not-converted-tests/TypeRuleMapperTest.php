<?php

namespace Webforge\Types;

use Psc\Form\IdValidatorRule;

/**
 * @group class:Webforge\Types\TypeRuleMapper
 */
class TypeRuleMapperTest extends \Webforge\Types\Test\Base {
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\TypeRuleMapper';
    parent::setUp();
    $this->mapper = new TypeRuleMapper();
  }
  
  /**
   * @dataProvider provideMappings
   */
  public function testMapping($expectedRule, $type) {
    $this->assertEquals($expectedRule, $this->mapper->getRule($type));
  }
  
  
  public static function provideMappings() {
    $mapper = new TypeRuleMapper();
    
    $test = function ($type, $rule) use (&$tests, $mapper) {
      $type = Type::create($type);
      $tests[] = array($mapper->createRule($rule),$type);
    };
    
    $test('Id', 'Psc\Form\IdValidatorRule');
    $test('String', 'Psc\Form\NesValidatorRule');
    
    return $tests;
  }
  
  /**
   * @dataProvider provideRuleClasses
   */
  public function testCreateRule($expectedRule, $class) {
    $this->assertEquals($expectedRule, $this->mapper->createRule($class));
  }
  
  public static function provideRuleClasses() {
    return array(
      array(new IdValidatorRule, 'Id'),
      array(new IdValidatorRule, 'IdValidatorRule'),
      array(new IdValidatorRule, 'Psc\Form\IdValidatorRule')
    );
  }
}
