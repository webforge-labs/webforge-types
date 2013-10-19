<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\CodeType
 */
class CodeTypeTest extends TestCase {
  
  public function testMapsToCodeEditorComponent() {
    $this->assertTypeMapsComponent('CodeEditor', new CodeType());
  }
}
