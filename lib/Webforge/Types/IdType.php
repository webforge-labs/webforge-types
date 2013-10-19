<?php

namespace Webforge\Types;

use Webforge\Types\Adapters\TypeRuleMapper;

class IdType extends \Webforge\Types\PositiveIntegerType implements ValidationType, MappedComponentType {
  
  public function __construct() {
    parent::__construct();
    $this->setZero(FALSE);
  }
  
  public function getValidatorRule(TypeRuleMapper $mapper) {
    return $mapper->createRule('Id');
  }
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('IntegerField');
  }
}
?>