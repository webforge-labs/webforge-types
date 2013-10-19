<?php

namespace Webforge\Types;

class CodeType extends TextType implements MappedComponentType {

  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('CodeEditor');
  }
}
