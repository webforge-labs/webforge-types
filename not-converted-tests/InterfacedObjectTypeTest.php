<?php

namespace Webforge\Types;

use Webforge\Types\InterfacedObjectType;

/**
 * @group class:Webforge\Types\InterfacedObjectType
 */
class InterfacedObjectTypeTest extends \Webforge\Types\Test\Base {
  
  protected $type;

  public function setUp() {
    $this->chainClass = 'Webforge\Types\InterfacedObjectType';
    parent::setUp();
    $this->type = $this->getMock($this->chainClass, array('getInterface'));
  }

  public function testConstruct() {
    $this->assertChainable($this->type);
  }
  
  /**
   * @expectedException Webforge\Types\TypeException
   */
  public function testSetClassNullIsNotAllowed() {
    $this->type->setClass(NULL);
  }

  /**
   * @expectedException Webforge\Types\TypeException
   */
  public function testSetClassImplementsWrongInterfaceIsNotAllowed() {
    $this->type->expects($this->any())->method('getInterface')->will($this->returnValue('Psc\Unknown\Interface'));
    
    $this->type->setClass(new \Psc\Code\Generate\GClass('Webforge\Types\LinkType'));
  }

  public function testSetClassImplementsRightInterface() {
    $this->type->expects($this->any())->method('getInterface')->will($this->returnValue('Webforge\Types\InterfacedType'));
    
    $this->type->setClass(new \Psc\Code\Generate\GClass('Webforge\Types\LinkType'));
  }

  public function createInterfacedObjectType() {
    return new InterfacedObjectType();
  }
}
