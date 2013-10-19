<?php

namespace Webforge\Types;

use Webforge\Types\TextType;

/**
 * @group class:Webforge\Types\TextType
 */
class TextTypeTest extends TestCase {

  public function testMapsToSomeComponent() {
    $this->assertTypeMapsComponent('any', new TextType());
  }
}
