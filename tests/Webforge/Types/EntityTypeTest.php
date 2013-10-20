<?php

namespace Webforge\Types;

use Mockery as m;

/**
 * @group class:Webforge\Types\EntityType
 */
class EntityTypeTest extends \Webforge\Types\Test\TestCase {
  
  protected $entityType, $imageEntityType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\EntityType';
    parent::setUp();
    $this->entityType = new EntityType($this->fakePHPClassImplements('Psc\Doctrine\TestEntities\Person'));
    $this->imageEntityType = new EntityType($this->fakePHPClassImplements('Psc\Doctrine\Entities\BasicImage2', 'Psc\Image\Image'));
  }
  
  public function testAcceptance() {
    $this->assertTypeMapsComponent('ComboBox', $this->entityType);
  }

  public function testTypeMapsSingleImageComponent() {
    $this->assertTypeMapsComponent('SingleImage', $this->imageEntityType);
  }

  protected function fakePHPClassImplements($fqn, $interfaces = NULL) {
    $gClass = GClassAdapter::newGClass($fqn);
    $gClass->injectReflection($reflection = m::mock('ReflectionClass'));

    $reflection->shouldReceive('implementsInterface')->byDefault()->andReturnUsing(function($interface) use ($interfaces) {
      $interface = (string) $interface;
      return is_string($interfaces) && $interface === $interfaces;
    });

    return $gClass;
  }
}
