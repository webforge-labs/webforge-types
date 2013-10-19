<?php

namespace Webforge\Types;

use Webforge\Types\IntegerTypeTestCase;

/**
 * @group class:Webforge\Types\IntegerTypeTestCase
 */
class IntegerTypeTestCaseTest extends \Webforge\Types\Test\Base {

  public function testStubIncomplete() {
    $this->assertInstanceOf('Psc\Code\Test\Base', new IntegerTypeTestCase());
  }
}
