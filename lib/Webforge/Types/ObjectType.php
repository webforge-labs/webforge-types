<?php

namespace Webforge\Types;

use Psc\Code\Generate\GClass;
use Psc\Code\Code;
use Webforge\Common\ClassInterface;

class ObjectType extends Type implements ParameterHintedType, DoctrineExportableType {
  
  /**
   * @var ClassInterface
   */
  protected $class;
  
  public function __construct(ClassInterface $class = NULL) {
    if (isset($class)) {
      $this->setClass($class);
    }
  }

  public function getName($context = self::CONTEXT_DEFAULT) {
    if ($context === self::CONTEXT_DEBUG)
      return isset($this->class) ? $this->class->getFQN() : 'Object';
      
    return parent::getName($context);
  }
  
  public function expandNamespace($namespace) {
    if (isset($this->class) && $this->class->getNamespace() === NULL)
      $this->class->setNameSpace($namespace);
    return $this;
  }
  
  /**
   * @return NULL|String
   */
  public function getClassFQN() {
    return isset($this->class) ? $this->class->getFQN() : NULL;
  }
  
  /**
   * @param Webforge\Common\ClassInterface $class
   * @chainable
   */
  public function setClass(ClassInterface $class = NULL) {
    $this->class = $class;
    return $this;
  }

  /**
   * @return ClassInterface
   */
  public function getClass() {
    return $this->class;
  }
  
  public function getGClass() {
    return $this->class;
  }
  
  public function hasClass() {
    return isset($this->class);
  }
  
  /**
   * Gibt den internen PHPTypen des Types zurück
   *
   * ist in diesem falle auch der DocType
   * wenn die Klasse gesetzt ist, wird der Name der Klasse ohne \ Davor zurückgegeben
   */
  public function getPHPType() {
    return isset($this->class) ? $this->class->getFQN() : 'object';
  }

  /**
   * Returns the PHPHint as php code for the Object
   * 
   * if class is not known \stdClass is returned
   * 
   * e.g. encodeJSON(\stdClass $object)
   * 
   * if class is known and namespace context is the same as the class only the relative className will be returned
   * 
   * e.g. setPerson(Person $person)
   * 
   * if class is known and namespace context is not set the full qualified name with \ in front will be returned
   * 
   * e.g. setPerson(\ACME\Entities\Person $person)
   */
  public function getPHPHint($namespaceContext = NULL) {
    if (!isset($this->class)) {
      return '\stdClass';
    }

    if (isset($namespaceContext) && trim($this->class->getNamespace(),'\\') === trim($namespaceContext,'\\')) {
      return $this->class->getName();
    }

    return '\\'.$this->class->getFQN();
  }
  
  /**
   * @inheritdoc
   */
  public function getParameterHint($useFQN = TRUE) {
    if (!isset($this->class)) {
      return $useFQN ? '\\stdClass' : 'stdClass';
    }

    if ($useFQN) {
      return '\\'.$this->class->getFQN();
    } else {
      return $this->class->getName();
    }
  }
  
  /**
   * @inheritdoc
   */
  public function getParameterHintImport() {
    return $this->class;
  }
  
  public function getDoctrineExportType() {
    return \Doctrine\DBAL\Types\Type::OBJECT;
  }

  public function implementsInterface($FQN) {
    if (!($FQN instanceof ClassInterface)) {
      $FQN = GClassAdapter::newGClass($FQN);
    }
    
    return $this->getGClass()->getReflection()->implementsInterface($FQN);
  }
}
