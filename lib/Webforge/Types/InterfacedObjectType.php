<?php

namespace Webforge\Types;

use Webforge\Common\ClassInterface;

abstract class InterfacedObjectType extends ObjectType implements InterfacedType {

  public function setClass(ClassInterface $class = NULL) {
    if ($class === NULL) {
      throw new TypeException('Für InterfacedObjectType kann Parameter 1 von setClass nicht NULL sein');
    }
    
    try {
      if ($class->getReflection()->implementsInterface($this->getInterface())) {
        return parent::setClass($class);
      }
      
    } catch (\ReflectionException $e) {}
      
    throw new TypeException(
      sprintf("The Class '%s' for %s has to implement: '%s'.", $class->getFQN(), get_class($this), $this->getInterface())
    );
  }
  
  public function getPHPHint($namespaceContext = NULL) {
    return $this->getInterface(); // @TODO this fails to respect namespaceContext
  }
}
