<?php

namespace Webforge\Types;

use Webforge\Types\Adapters\ComponentMapper;

interface MappedComponentType {

  /**
   * am besten ist es den $componentMapper zu benutzen, um die Componente zu instanziieren:
   *
   *  return $componentMapper->createComponent('BirthdayPicker');
   * 
   * @return Psc\CMS\Component
   */
  public function getMappedComponent(ComponentMapper $componentMapper);
  
}
