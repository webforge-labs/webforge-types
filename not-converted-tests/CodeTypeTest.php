<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\CodeType
 */
class CodeTypeTest extends \Webforge\Types\Test\TestCase {
  
  public function testMapsToCodeEditorComponent() {
    $this->assertTypeMapsComponent('CodeEditor', new CodeType());
  }
}
