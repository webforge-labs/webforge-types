<?php

namespace Webforge\Types;

class TextType extends \Webforge\Types\StringType implements \Webforge\Types\MappedComponentType,\Psc\Doctrine\ExportableType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('TextBox');
  }

  public function getDoctrineExportType() {
    return 'text';
  }
}
