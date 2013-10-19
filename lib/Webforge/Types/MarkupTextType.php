<?php

namespace Webforge\Types;

class MarkupTextType extends \Webforge\Types\TextType {

  public function getMappedComponent(\Psc\CMS\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('TextBox');
  }
}
