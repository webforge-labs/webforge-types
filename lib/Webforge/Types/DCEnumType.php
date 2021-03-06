<?php

namespace Webforge\Types;

use Psc\CMS\Labeler;
use Webforge\Types\Adapters\ComponentMapper;
use Webforge\Types\Adapters\TypeRuleMapper;
use Webforge\Common\ClassInterface;
use Psc\Doctrine\ExportableType;

class DCEnumType extends Type implements DoctrineExportableType, ValidationType, MappedComponentType, WalkableHintType {
  
  /**
   * 
   * @var ClassInterface
   */
  protected $typeClass;
  
  /**
   * @var Psc\CMS\Labeler
   */
  protected $labeler;
  
  /**
   * Die Klasse des Types
   */
  public function __construct(ClassInterface $typeClass, Array $valueLabels = array(), Labeler $labeler = NULL) {
    $this->typeClass = $typeClass;
    $this->setLabeler($labeler ?: new Labeler); // auch getter injection
    
    foreach ($valueLabels as $value=>$label) {
      $this->labeler->label($value, $label);
    }
  }
  
  /**
   * 
   * 
   * @return Psc\CMS\Component
   */
  public function getMappedComponent(ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('Radios')
      ->setValues(
        array_combine($values = $this->getEnumType()->getValues(),
                      $this->getLabels($values)
                      )
       );
  }
  
  public function getEnumType() {
    $c = $this->typeClass->getFQN();
    return $c::instance();
  }
  
  public function getWalkableHint() {
    return 'String';
  }
  
  public function hasClass() {
    return isset($this->typeClass);
  }

  /**
   * @return ClassInterface
   */
  public function getClass() {
    return $this->typeClass;
  }
  
  public function getDoctrineExportType() {
    return $this->getEnumType()->getName();
  }
  
  public function getValidatorRule(TypeRuleMapper $mapper) {
    // pass values to validator rule
    return $mapper->createRule('Values', array($this->getEnumType()->getValues()));
  }
  
  protected function getLabels(Array $values) {
    $labels = array();
    $labeler = $this->getLabeler();
    foreach ($values as $key=>$value) {
      $labels[] = $labeler->getLabel($value);
    }
    return $labels;
  }
  
  public function exportLabels() {
    return $this->getLabeler()->getCustomLabels();
  }
  
  public function getDocType() {
    return $this->typeClass->getFQN();
  }
  
  /**
   * @param Psc\CMS\Labeler $labeler
   */
  public function setLabeler(Labeler $labeler) {
    $this->labeler = $labeler;
    return $this;
  }
  
  /**
   * @return Psc\CMS\Labeler
   */
  public function getLabeler() {
    if (!isset($this->labeler)) {
      $this->labeler = new Labeler();
    }
    return $this->labeler;
  }
}
