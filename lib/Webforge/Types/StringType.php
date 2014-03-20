<?php

namespace Webforge\Types;

use Webforge\Types\Adapters\TypeRuleMapper;
use Webforge\Types\Adapters\ComponentMapper;

class StringType extends Type implements DoctrineExportableType, MappedComponentType, ValidationType, WalkableHintType, SerializationType {

  public function getMappedComponent(ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('TextField');
  }
  
  public function getWalkableHint() {
    return 'String';
  }
  
  public function getDoctrineExportType() {
    return 'string';
  }
  
  public function getValidatorRule(TypeRuleMapper $mapper) {
    return $mapper->createRule('Nes');
  }

  public function getSerializationType() {
    return 'string';
  }
}
