<?php

namespace Webforge\Types;

use Webforge\Types\MarkupTextType;

/**
 * @group class:Webforge\Types\MarkupTextType
 */
class MarkupTextTypeTest extends TestCase {

  public function testMapsSome() {
    $this->assertTypeMapsComponent('any', new MarkupTextType());
  }
}
