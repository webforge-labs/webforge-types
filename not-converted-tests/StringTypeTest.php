<?php

namespace Webforge\Types;

use Webforge\Types\StringType;

/**
 * @group class:Webforge\Types\StringType
 */
class StringTypeTest extends \Webforge\Types\Test\TestCase {

  public function testConstruct() {
    $stringType = new StringType();
    
    $this->assertDocType('string', $stringType);
    $this->assertTypeMapsComponent('TextField', $stringType);
  }
}
