<?php

namespace Webforge\Types;

interface WalkableHintType {
  
  /**
   * Returns a string as function name expanding to Walker::walk$hint()
   *
   * @return string
   */
  public function getWalkableHint();
}
