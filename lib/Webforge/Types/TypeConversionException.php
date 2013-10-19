<?php

namespace Webforge\Types;

class TypeConversionException extends TypeException {
  
  public static function typeTarget($fromType, $target) {
    return new static(sprintf("Type '%s' could not be conversed to %s", $fromType, $target));
  }
}
