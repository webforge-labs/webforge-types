<?php

namespace Webforge\Types;

use Webforge\Types\MarkupTextType;

/**
 * @group class:Webforge\Types\MarkupTextType
 */
class MarkupTextTypeTest extends \Webforge\Types\Test\TestCase {

  public function testMapsSome() {
    $this->assertTypeMapsComponent('any', new MarkupTextType());
  }
}
