<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\DateType
 */
class DateTypeTest extends TestCase {
  
  protected $dateType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\DateType';
    parent::setUp();
    $this->dateType = new DateType();
  }
  
  public function testMapsToComponentDatePicker() {
    $this->assertTypeMapsComponent('DatePicker', $this->dateType);
  }

  public function testIsAObjectTypeForDate() {
    $this->assertObjectType('Webforge\Common\DateTime\Date', $this->dateType);
  }
}
