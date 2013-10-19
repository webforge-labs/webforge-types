<?php

namespace Webforge\Types;

use Psc\Form\PositiveIntValidatorRule;
use Webforge\Types\Adapters\TypeRuleMapper;

class PositiveIntegerType extends \Webforge\Types\IntegerType implements ValidationType, MappedComponentType {
  
  public function getValidatorRule(TypeRuleMapper $mapper) {
    return $mapper->createRule(new PositiveIntValidatorRule($this->hasZero()));
  }  
  
  /**
   *
   * @return Psc\CMS\Component
   */
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('IntegerField');
  }
}
