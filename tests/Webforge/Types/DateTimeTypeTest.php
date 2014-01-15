<?php

namespace Webforge\Types;

use Webforge\Types\DateTimeType;

class DateTimeTypeTest extends \Webforge\Types\Test\TestCase {

  public function setUp() {
    $this->chainClass = 'Webforge\Types\DateTimeType';
    parent::setUp();
  }

  public function testDoctrineExportableType() {
    $this->assertEquals('WebforgeDateTime', Type::create('DateTime')->getDoctrineExportType());
  }

  public function testIsAObjectTypeForDateTime() {
    $this->assertObjectType('Webforge\Common\DateTime\DateTime', Type::create('DateTime'));
  }
  
  public function testMapsToComponentDateTimePicker() {
    $this->assertTypeMapsComponent('DateTimePicker', Type::create('DateTime'));
  }
}
