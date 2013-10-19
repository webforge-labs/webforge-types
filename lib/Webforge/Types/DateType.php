<?php

namespace Webforge\Types;

class DateType extends \Webforge\Types\ObjectType implements DoctrineExportableType, MappedComponentType {
  
  public function getDoctrineExportType() {
    return 'PscDate';
  }

  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('DatePicker');
  }
  
  public function __construct() {
    parent::__construct(GClassAdapter::newGClass('Webforge\Common\DateTime\Date'));
  }
}
