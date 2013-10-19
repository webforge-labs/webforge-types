<?php

namespace Webforge\Types;

class SmallIntegerType extends \Webforge\Types\IntegerType implements MappedComponentType, \Psc\Doctrine\ExportableType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('SmallIntegerField');
  }
  
  public function getDoctrineExportType() {
    return 'smallint';
  }
}
