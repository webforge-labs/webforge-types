<?php

namespace Webforge\Types;

class EmailType extends StringType implements MappedComponentType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('EmailField');
  }
}
