<?php

namespace Webforge\Types;

class GClassAdapter {

  /**
   * @return Webforge\Common\ClassInterface
   */
  public static function newGClass($fqn) {
    return new \Webforge\Common\PHPClass($fqn);
  }
}
