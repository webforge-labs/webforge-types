<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\PasswordType
 */
class PasswordTypeTest extends TestCase {
  
  protected $passwordType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\PasswordType';
    parent::setUp();
    $this->passwordType = new PasswordType();
  }
  
  public function testAcceptance() {
    $this->assertTypeMapsComponent('PasswordFields',$this->passwordType);
  }
}
