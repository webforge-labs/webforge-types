<?php

namespace Webforge\Types;

class MarkupTextType extends \Webforge\Types\TextType {

  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('TextBox');
  }
}
