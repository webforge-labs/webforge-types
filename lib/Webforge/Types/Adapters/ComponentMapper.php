<?php

namespace Webforge\Types\Adapters;

interface ComponentMapper {

  /**
   * @param string the name of the Component without Component appended
   */
  public function createComponent($className);
}
