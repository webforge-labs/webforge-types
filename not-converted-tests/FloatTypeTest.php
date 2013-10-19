<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\FloatType
 */
class FloatTypeTest extends \Webforge\Types\Test\TestCase {
  
  protected $floatType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\FloatType';
    parent::setUp();
    $this->floatType = new FloatType();
  }
  
  public function testAcceptance() {
    $this->assertTypeMapsComponent('FloatField', $this->floatType);
  }
}
