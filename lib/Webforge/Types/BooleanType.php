<?php

namespace Webforge\Types;

class BooleanType extends Type implements MappedComponentType, DoctrineExportableType, SerializationType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('Checkbox');
  }

  public function getDoctrineExportType() {
    return 'boolean';
  }

  public function getSerializationType() {
    return 'boolean';
  }
}
