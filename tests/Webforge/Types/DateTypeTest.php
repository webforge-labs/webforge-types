<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\DateType
 */
class DateTypeTest extends \Webforge\Types\Test\TestCase {
  
  protected $dateType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\DateType';
    parent::setUp();
    $this->type = $this->dateType = new DateType();
  }
  
  public function testMapsToComponentDatePicker() {
    $this->assertTypeMapsComponent('DatePicker', $this->dateType);
  }

  public function testIsAObjectTypeForDate() {
    $this->assertObjectType('Webforge\Common\DateTime\Date', $this->dateType);
  }

  public function testHasASerializationType() {
    $this->assertTypeSerializes('Webforge\Common\DateTime\Date');
  }
}
