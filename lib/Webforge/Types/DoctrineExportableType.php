<?php

namespace Webforge\Types;

interface DoctrineExportableType {

  /**
   * Returns a string that can be used as @Doctrine\ORM\Mapping\Column(type="%s")
   */
  public function getDoctrineExportType();
  
}
