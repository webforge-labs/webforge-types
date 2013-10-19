<?php

namespace Webforge\Types;

class PositiveSmallIntegerType extends PositiveIntegerType implements MappedComponentType, DoctrineExportableType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('SmallIntegerField');
  }
  
  public function getDoctrineExportType() {
    return 'smallint';
  }
}
