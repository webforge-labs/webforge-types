<?php

namespace Webforge\Types;

use Webforge\Types\Adapters\TypeRuleMapper;

/**
 * Ein EnumType ist ein Type mit festgelegten Values die auf dem inneren Type ($valueType) basieren
 *
 * Ein Enum hat also einen inneren Type
 * die Value eines EnumType ist somit immer der innere Type
 *
 * nicht mit DCEnumType verwechseln (welcher eher Datenbank basierend ist)
 *
 * alle weiteren Eigenschaften des EnumTypes werden durch den valueType bestimmt. Das liegt daran, weil der EnumType nur eine Einschränkung des Universums des ValueTypes ist
 * der EnumType ist also ein TemplateType für ValueType (so ists glaub ich im C jargon)
 */
class EnumType extends Type implements EnclosingType, MappedComponentType, ValidationType, DoctrineExportableType, WalkableHintType {

  /**
   * Der Typ von dem die Werte des Enums sind
   *
   * @var Webforge\Types\Type
   */
  protected $valueType;
  
  /**
   * @var {$this->valueType}[] ein array des inneren ValueTypes
   */
  protected $values;
 
  public function __construct(WalkableHintType $valueType, Array $values) {
    $this->valueType = $valueType;
    $this->values = $values;
  }

  /**
   * @return Psc\CMS\Component
   */
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    $selectBox = $componentMapper->createComponent('SelectBox');
    $selectBox->dpi($this->getValues()); // wir überlassen der componente das Labeling
    // bei DCEnumType haben wir das im Type selbst gemacht - weis nicht so recht
    return $selectBox;
  }
  
  public function getValidatorRule(TypeRuleMapper $mapper) {
    return $mapper->createRule('ValuesValidatorRule', array($this->values));
  }

  /**
   * Gibt den String zurück, der in @Doctrine\ORM\Mapping\Column(type="%s")  benutzt werden kann
   */
  public function getDoctrineExportType() {
    return $this->valueType->getDoctrineExportType();
  }
  
  /**
   * @return String
   */
  public function getDocType() {
    return $this->valueType->getDocType();
  }

  public function getWalkableHint() {
    return $this->valueType->getWalkableHint();
  }
  
  /**
   * @return bool
   */
  public function isTyped() {
    return TRUE;
  }
  
  /**
   * @return Webforge\Types\Type
   * @throws NotTypedException wenn der Type nicht gesetzt ist
   */
  public function getType() {
    return $this->valueType;
  }
  
  /**
   * 
   * wird der Parameter NULL Übergeben ist der Type nicht mehr getyped
   * @param Webforge\Types\Type|NULL
   */
  public function setType(Type $type = NULL) {
    throw new Exception('Value Type ist immutable und kann nicht gesetzt werden');
  }
  
  /**
   * @param mixed[] $values
   * @chainable
   */
  public function setValues($values) {
    $this->values = $values;
    return $this;
  }

  /**
   * @return mixed[]
   */
  public function getValues() {
    return $this->values;
  }
}
