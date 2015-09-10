<?php

namespace Webforge\Types;

use Webforge\Common\ClassInterface;

class PersistentCollectionType extends \Webforge\Types\CollectionType {
  
  public function __construct(ClassInterface $entityClass, $implementation = self::WEBFORGE_COLLECTION) {
    parent::__construct(
      $implementation,
      new EntityType($entityClass)
    );
  }
}
