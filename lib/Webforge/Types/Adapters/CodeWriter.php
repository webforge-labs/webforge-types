<?php

namespace Webforge\Types\Adapters;

use Webforge\Common\ClassInterface;

/**
 * not used yet
 */
interface CodeWriter {

  public function writeConstructor(ClassInterface $class, $parametersPHPCode);
}
