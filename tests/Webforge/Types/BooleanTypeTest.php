<?php

namespace Webforge\Types;

use Webforge\Types\BooleanType;

/**
 * @group class:Webforge\Types\BooleanType
 */
class BooleanTypeTest extends Test\TestCase {

  protected $type;

  public function setUp() {
    $this->type = new BooleanType();
    parent::setUp();
  }

  public function testImplementsDoctrineExportableType() {
    $this->assertInstanceOf('Webforge\Types\DoctrineExportableType', $this->type);
  }

  public function testHasASerializationType() {
    $this->assertTypeSerializes('boolean');
  }
}
