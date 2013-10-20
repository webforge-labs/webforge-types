<?php

namespace Webforge\Types;

class EnumTypeTest extends \Webforge\Types\Test\TestCase {
  
  protected $enumType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\EnumType';
    parent::setUp();
    $this->enumType = new EnumType(Type::create('String'), array('v1','v2'));
  }
  
  public function testInterfaces() {
    // enclosing: weil wir als Enum auf einen Template-Type projezieren können
    $this->assertInstanceOf('Webforge\Types\EnclosingType', $this->enumType);
    $this->assertInstanceOf('Webforge\Types\ValidationType', $this->enumType);
  }
  
  public function testComponentMapping() {
    $componentMock = $this->expectTypeMapsComponent('Psc\UI\Component\SelectBox', $this->enumType);
    $componentMock->shouldReceive('dpi')->once()->with(array('v1', 'v2'));

    $this->enumType->getMappedComponent($this->mapper);
  }
  
  public function testSetTypeIsNotAllowed() {
    $this->setExpectedException(__NAMESPACE__.'\Exception');
    $this->enumType->setType(Type::create('String'));
  }
}
