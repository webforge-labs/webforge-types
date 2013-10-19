<?php

namespace Webforge\Types;

use Webforge\Types\Adapters\ComponentMapper;

class EntityType extends ObjectType implements MappedComponentType {
  
  /**
   * Returnst the component that is mapped per default for this Type
   * 
   * use the componentMapper to create the component
   * 
   *  return $componentMapper->createComponent('BirthdayPicker');
   * 
   * @return Psc\CMS\Component
   */
  public function getMappedComponent(ComponentMapper $componentMapper) {
    if ($this->isImage()) {
      return $componentMapper->createComponent('SingleImage');
    }
    
    return $componentMapper->createComponent('ComboBox');
  }

  /**
   * Gibt zurück ob die EntityKlasse Psc\Image\Image implementiert
   * 
   * @var bool
   */
  public function isImage() {
    return $this->implementsInterface('Psc\Image\Image');
  }

  /**
   * @return bool
   */
  public function isCSEntry() {
    return $this->implementsInterface('Psc\TPL\ContentStream\Entry');
  }
}
