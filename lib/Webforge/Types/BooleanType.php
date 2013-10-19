<?php

namespace Webforge\Types;

class BooleanType extends Type implements \Webforge\Types\MappedComponentType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('Checkbox');
  }
}
