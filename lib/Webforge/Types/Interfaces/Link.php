<?php

namespace Webforge\Types\Interfaces;

interface Link {
  
  /**
   * Gibt die Beschriftung des Links zurück
   * 
   * @return string
   */
  public function getLabel();
  
  /**
   * Gibt die URI des Links zurück
   *
   * @return string<URI>
   */
  public function getURI();
  
}
