<?php

namespace Webforge\Types;

use Psc\Code\Generate\GClass;

/**
 * @group class:Webforge\Types\EntityType
 */
class EntityTypeTest extends \Webforge\Types\Test\TestCase {
  
  protected $entityType, $imageEntityType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\EntityType';
    parent::setUp();
    $this->entityType = new EntityType(GClassAdapter::newGClass('Psc\Doctrine\TestEntities\Person'));
    $this->imageEntityType = new EntityType(GClassAdapter::newGClass('Psc\Doctrine\Entities\BasicImage2'));
  }
  
  public function testAcceptance() {
    $this->assertTypeMapsComponent('ComboBox', $this->entityType);
  }

  public function testTypeMapsSingleImageComponent() {
    $this->assertTypeMapsComponent('SingleImage', $this->imageEntityType);
  }
}
