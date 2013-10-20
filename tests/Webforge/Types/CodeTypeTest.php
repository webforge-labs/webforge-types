<?php

namespace Webforge\Types;

class CodeTypeTest extends \Webforge\Types\Test\TestCase {
  
  public function testMapsToCodeEditorComponent() {
    $this->assertTypeMapsComponent('CodeEditor', new CodeType());
  }
}
