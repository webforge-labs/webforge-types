<?php

namespace Webforge\Types;

use Webforge\Common\Util;

class Inferrer {
  
  /**
   * Versucht den Typ von einem PHP-Basis-Datentyp zu erraten
   *
   * @throws Webforge\Types\InferException
   */
  public function inferType($value) {
    if (is_string($value)) {
      return new StringType();
    } elseif (is_array($value)) {
      return new ArrayType();
    } elseif (is_object($value)) {
      return $this->inferObjectType($value);
    } elseif (is_integer($value)) {
      return new IntegerType();
    } elseif (is_bool($value)) {
      return new BooleanType();
    } elseif(is_null($value)) {
      return new MixedType();
    }

    $e = new InferException('Typ konnte nicht geraten werden: '.Util::varInfo($value));
    $e->value = $value;
    throw $e;
  }
  
  public function inferObjectType($object) {
    $objectClass = GClassAdapter::newGClass(get_class($object));
    if ($object instanceof \Doctrine\Common\Collections\Collection) {
      return new CollectionType($objectClass);
    } else {
      return new ObjectType($objectClass);
    }
  }
}
