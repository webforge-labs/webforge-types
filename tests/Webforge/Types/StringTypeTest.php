<?php

namespace Webforge\Types;

use Webforge\Types\StringType;

/**
 * @group class:Webforge\Types\StringType
 */
class StringTypeTest extends \Webforge\Types\Test\TestCase {

  public function setUp() {
    parent::setUp();

    $this->type = Type::create('String');
  }

  public function testConstruct() {
    $stringType = new StringType();
    
    $this->assertDocType('string', $stringType);
    $this->assertTypeMapsComponent('TextField', $stringType);
  }

  public function testHasASerializationType() {
    $this->assertTypeSerializes('string');
  }
}
