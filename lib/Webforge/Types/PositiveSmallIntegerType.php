<?php

namespace Webforge\Types;

class PositiveSmallIntegerType extends \Webforge\Types\PositiveIntegerType implements MappedComponentType, \Psc\Doctrine\ExportableType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('SmallIntegerField');
  }
  
  public function getDoctrineExportType() {
    return 'smallint';
  }
}
