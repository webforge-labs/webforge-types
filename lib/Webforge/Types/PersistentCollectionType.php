<?php

namespace Webforge\Types;

use Webforge\Common\ClassInterface;

class PersistentCollectionType extends \Webforge\Types\CollectionType {
  
  public function __construct(ClassInterface $entityClass) {
    parent::__construct(
      self::WEBFORGE_COLLECTION,
      new EntityType($entityClass)
    );
  }
}
