<?php

namespace Webforge\Types;

use Webforge\Types\Test\TestCase;

class IntegerTypeTestCase extends TestCase {

  public function testConstruct() {
    $type = new IntegerType();
    
    return $type;
  }
  
  public function testTypeMapsAComponent() {
    $this->assertTypeMapsComponent('any', new IntegerType);
  }
  
  /**
   * @depends testConstruct
   */
  public function testZero(IntegerType $type) {
    $this->assertTrue($type->hasZero());
    
    $type->setZero(FALSE);
    $this->assertFalse($type->hasZero());

    $type->setZero(TRUE);
    $this->assertTrue($type->hasZero());
  }
}
