<?php

namespace Webforge\Types;

use Webforge\Types\BirthdayType;

class BirthdayTypeTest extends \Webforge\Types\Test\TestCase {

  public function setUp() {
    $this->chainClass = 'Webforge\Types\BirthdayType';
    parent::setUp();
  }
  
  public function testMaps() {
    $this->assertTypeMapsComponent('Psc\UI\Component\BirthdayPicker', new BirthdayType());
  }
}
