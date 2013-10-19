<?php

namespace Webforge\Types;

class GClassAdapterTest extends \Webforge\Code\Test\Base {
  
  public function setUp() {
    $this->chainClass = __NAMESPACE__ . '\\GClassAdapter';
    parent::setUp();
  }

  public function testGClassAdapterReturnsAlawaysAWebforgeCommonClassInterface() {
    $this->assertInstanceOf('Webforge\Common\ClassInterface', $gClass = GClassAdapter::newGClass(__CLASS__));

    $this->assertEquals(__CLASS__, $gClass->getFQN());
    $this->assertEquals('GClassAdapterTest', $gClass->getName());
    $this->assertEquals(__NAMESPACE__, $gClass->getNamespace());
  }
}
