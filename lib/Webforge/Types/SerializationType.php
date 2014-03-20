<?php

namespace Webforge\Types;

interface SerializationType {
  
  /**
   * The type returned for the (jms) serializer
   * 
   * can return NULL for undefined types (some sensible context default should be used)
   * see http://jmsyst.com/libs/serializer/master/reference/annotations#type
   * @return string|NULL
   */
  public function getSerializationType();
}
