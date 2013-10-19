<?php

namespace Webforge\Types;

use Webforge\Types\StringType;

/**
 * @group class:Webforge\Types\StringType
 */
class StringTypeTest extends TestCase {

  public function testConstruct() {
    $stringType = new StringType();
    
    $this->assertDocType('string', $stringType);
    $this->assertTypeMapsComponent('TextField', $stringType);
  }
}
