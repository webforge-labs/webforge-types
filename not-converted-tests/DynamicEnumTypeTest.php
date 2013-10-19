<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\DynamicEnumType
 */
class DynamicEnumTypeTest extends \Webforge\Types\Test\Base {
  
  protected $dynamicEnumType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\DynamicEnumType';
    parent::setUp();
    //$this->dynamicEnumType = new DynamicEnumType();
  }
  
  public function testAcceptance() {
    $this->markTestIncomplete('vom tiptoi acceptance test für gameTypeClass kopieren');
  }
}
