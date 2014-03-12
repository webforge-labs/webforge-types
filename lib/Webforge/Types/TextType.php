<?php

namespace Webforge\Types;

class TextType extends StringType implements MappedComponentType, DoctrineExportableType {
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('TextBox');
  }

  public function getDoctrineExportType() {
    return 'string'; //text: Type that maps an SQL CLOB to a PHP string., that is too much, string is okay, too
  }
}
