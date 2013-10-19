<?php

namespace Webforge\Types\Adapters;

use Webforge\Common\ClassInterface;

interface CodeWriter {

  public function writeConstructor(ClassInterface $class, $parametersPHPCode);
}
