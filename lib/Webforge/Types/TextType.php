<?php

namespace Webforge\Types;

class TextType extends StringType implements MappedComponentType, DoctrineExportableType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('TextBox');
  }

  public function getDoctrineExportType() {
    return 'text'; // allthough text is really big, string is to small
  }
}
