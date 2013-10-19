<?php

namespace Webforge\Types;

use Webforge\Types\DateTimeType;

/**
 * @group class:Webforge\Types\DateTimeType
 */
class DateTimeTypeTest extends \Webforge\Types\Test\TestCase {

  public function setUp() {
    $this->chainClass = 'Webforge\Types\DateTimeType';
    parent::setUp();
  }

  public function testIsAObjectTypeForDateTime() {
    $this->assertObjectType('Webforge\Common\DateTime\DateTime', Type::create('DateTime'));
  }
  
  public function testMapsToComponentDateTimePicker() {
    $this->assertTypeMapsComponent('DateTimePicker', Type::create('DateTime'));
  }
}
