<?php

namespace Webforge\Types;

class BirthdayType extends \Webforge\Types\DateType implements MappedComponentType {

  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('BirthdayPicker');
  }
}
