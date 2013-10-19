<?php

namespace Webforge\Types;

class LinkType extends \Webforge\Types\CompositeType implements InterfacedType {
  
  public function __construct() {
    $this->setComponents(new URIType(), new StringType());
    parent::__construct();
  }
  
  public function getInterface() {
    return $this->getInterfaceDefinition('Link');
  }
  
  protected function defineHint() {
    $this->phpHint = $this->getInterface();
  }
}
