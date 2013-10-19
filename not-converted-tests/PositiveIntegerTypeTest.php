<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\PositiveIntegerType
 */
class PositiveIntegerTypeTest extends IntegerTypeTestCase {
  
  protected $positiveIntegerType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\PositiveIntegerType';
    parent::setUp();
    $this->positiveIntegerType = new PositiveIntegerType();
  }

  public function testConstruct() {
    $type = new PositiveIntegerType();
    
    return $type;
  }
  
  public function testMapsComponent() {
    $this->assertTypeMapsComponent('any', $this->positiveIntegerType);
  }
  
}
