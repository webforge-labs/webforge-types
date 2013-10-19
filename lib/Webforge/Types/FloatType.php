<?php

namespace Webforge\Types;

use Webforge\Types\Adapters\TypeRuleMapper;

class FloatType extends \Webforge\Types\Type implements \Psc\Doctrine\ExportableType, \Webforge\Types\MappedComponentType, \Webforge\Types\ValidationType {

  /**
   * @var bool
   */
  protected $zero = TRUE;

  /**
   * Die Anzahl der Stellen mit dem der Float formatiert werden soll beider Ausgabe
   * 
   * ka ob 2 ein schöner default ist
   * @var int
   */
  protected $decimals = 2;
  
  /**
   * @return bool
   */
  public function hasZero() {
    return $this->zero;
  }
  
  /**
   * @param bool $zero
   * @chainable
   */
  public function setZero($zero) {
    $this->zero = $zero == TRUE;
    return $this;
  }
  
  /**
   * @param int $decimals
   * @chainable
   */
  public function setDecimals($decimals) {
    $this->decimals = $decimals;
    return $this;
  }

  /**
   * @return int
   */
  public function getDecimals() {
    return $this->decimals;
  }

  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    $floatField = $componentMapper->createComponent('FloatField');
    $floatField->setDecimals($this->decimals);
    return $floatField;
  }
  
  public function getDoctrineExportType() {
    return 'float';
  }
  
  public function getPHPType() {
    return 'float';
  }

  public function getValidatorRule(TypeRuleMapper $mapper) {
    return $mapper->createRule('Float', array($this->hasZero()));
  }

  public function __toString() {
    return '[Type:'.$this->getTypeClass()->getFQN().' Zero:'.($this->hasZero() ? 'true' : 'false').']';
  }
}
?>