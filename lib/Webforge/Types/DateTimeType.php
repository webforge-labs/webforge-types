<?php

namespace Webforge\Types;

use Webforge\Types\Adapters\TypeRuleMapper;

/**
 *
 * Änderungen: siehe auch class DateType
 */
class DateTimeType extends \Webforge\Types\ObjectType implements DoctrineExportableType, MappedComponentType, ValidationType {
  
  public function getDoctrineExportType() {
    return 'WebforgeDateTime';
  }
  
  public function getValidatorRule(TypeRuleMapper $mapper) {
    return $mapper->createRule('DateTime');
  }

  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('DateTimePicker');
  }
  
  public function __construct() {
    parent::__construct(GClassAdapter::newGClass('Webforge\Common\DateTime\DateTime'));
  }  
}
