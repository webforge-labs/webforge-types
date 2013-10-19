<?php

namespace Webforge\Types;

use Psc\Code\Generate\GClass;

/**
 * @group class:Webforge\Types\TypeMatcher
 */
class TypeMatcherTest extends \Webforge\Types\Test\Base {
  
  protected $matcher;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\TypeMatcher';
    parent::setUp();
    $this->matcher = $this->createTypeMatcher();
  }
  
  /**
   * @dataProvider provideMatchingData
   */
  public function testMatching($result, $data, Type $type) {
    $this->assertEquals($result, $this->matcher->isTypeOf($data, $type));
  }
  
  public static function provideMatchingData() {
    $tests = array();
    $match = function ($data, $type) use (&$tests) {
      if (!($type instanceof Type)) $type = Type::create($type);
      $tests[] = array(TRUE, $data, $type);
    };
    $fail = function ($data, $type) use (&$tests) {
      if (!($type instanceof Type)) $type = Type::create($type);
      $tests[] = array(FALSE, $data, $type);
    };
    
    // base Types
    $match('blubb','String');
    $match(7,'Integer');
    $match(array(1,2,3),'Array');
    $match((object) array(1,2,3), 'Object');
    $match(new \Psc\DataInput, new ObjectType(GClassAdapter::newGClass('Psc\DataInput')));
    
    $fail(0, 'String');
    $fail('s', 'Integer');
    
    //extended types
    $match(7, 'PositiveInteger');
    $fail(-7, 'PositiveInteger');
    $fail(0, Type::create('PositiveInteger')->setZero(FALSE));
    $match(0, Type::create('PositiveInteger')->setZero(TRUE));
    
    return $tests;
  }
  
  public function createTypeMatcher() {
    return new TypeMatcher();
  }
}
?>