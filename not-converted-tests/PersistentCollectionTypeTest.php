<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\PersistentCollectionType
 */
class PersistentCollectionTypeTest extends \Webforge\Types\Test\Base {
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\PersistentCollectionType';
    parent::setUp();
  }
  
  public function testConstruct() {
    $pct = new PersistentCollectionType(new \Psc\Code\Generate\GClass('Psc\Doctrine\TestEntities\Tag'));
    $this->assertInstanceOf('Webforge\Types\CollectionType', $pct);
    
    $this->assertInstanceOf('Webforge\Types\ObjectType', $pct->getType());
    $this->assertEquals('Psc\Doctrine\TestEntities\Tag',$pct->getType()->getClass()->getFQN());
  }
}
