<?php

namespace Webforge\Types;

class BooleanType extends Type implements MappedComponentType, DoctrineExportableType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('Checkbox');
  }

  public function getDoctrineExportType() {
    return 'boolean';
  }
}
