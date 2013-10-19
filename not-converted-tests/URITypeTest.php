<?php

namespace Webforge\Types;

use Webforge\Types\URIType;

/**
 * @group class:Webforge\Types\URIType
 */
class URITypeTest extends TestCase {

  public function testMapsSomeComponent() {
    $this->assertTypeMapsComponent('any', new URIType());
  }
}
