<?php

namespace Webforge\Types;

class InferException extends \Webforge\Types\Exception {
  
  // die Value dessen Typ geraten werden sollte
  public $value;
}
