<?php

namespace Webforge\Types;

use Psc\Code\Generate\GClass;
use Webforge\Types\Adapters\TypeRuleMapper;

/**
 *
 * Änderungen: siehe auch class DateType
 */
class DateTimeType extends \Webforge\Types\ObjectType implements \Psc\Doctrine\ExportableType, MappedComponentType, ValidationType {
  
  public function getDoctrineExportType() {
    return 'PscDateTime';
    //return \Doctrine\DBAL\Types\Type::DATETIME;
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