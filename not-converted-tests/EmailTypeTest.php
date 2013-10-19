<?php

namespace Webforge\Types;

use Webforge\Types\EmailType;

/**
 * @group class:Webforge\Types\EmailType
 */
class EmailTypeTest extends TestCase {

  public function setUp() {
    $this->chainClass = 'Webforge\Types\EmailType';
    parent::setUp();
  }

  public function testConstruct() {
    $this->createEmailType();
  }

  public function testMapsComponent() {
    $this->assertTypeMapsComponent('EmailField', new EmailType);
  }

  public function createEmailType() {
    return new EmailType();
  }
}
