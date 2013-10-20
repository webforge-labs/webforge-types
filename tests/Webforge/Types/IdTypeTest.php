<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\IdType
 */
class IdTypeTest extends \Webforge\Types\Test\Base {
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\IdType';
    parent::setUp();
    $this->type = new IdType();
  }
  
  public function testAcceptance() {
    $this->assertInstanceOf('Webforge\Types\IntegerType',$this->type);
  }

}
