<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\MixedType
 */
class MixedTypeTest extends \Webforge\Types\Test\TestCase {
  
  protected $mixedType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\MixedType';
    parent::setUp();
    $this->mixedType = new MixedType();
  }
  
  public function testAcceptance() {
    $this->assertInstanceOf('Webforge\Types\PseudoType', $this->mixedType);
    $this->assertDocType('mixed', $this->mixedType);
  }
}
