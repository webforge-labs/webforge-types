<?php

namespace Webforge\Types;

/**
 * @group class:Psc\Data\Type\CollectionType
 */
class CollectionTypeTest extends \Webforge\Code\Test\Base {

  public function setUp() {
    $this->chainClass = 'Psc\Data\Type\CollectionType';
    parent::setUp();
  }

  public function testConstruct() {
    return Type::create('Collection');
  }

  public function testImplementationBadClass() {
    $this->setExpectedException('InvalidArgumentException');

    Type::create('Collection', 'nonsense');
  }
  
  public function testImplementationConstruct() {
    $type = Type::create('Collection', CollectionType::WEBFORGE_COLLECTION);
    $this->assertEquals('Webforge\Collections\ArrayCollection', $type->getClass()->getFQN());

    $type = Type::create('Collection', CollectionType::DOCTRINE_ARRAY_COLLECTION);
    $this->assertEquals('Doctrine\Common\Collections\ArrayCollection', $type->getClass()->getFQN());
  }
  
  public function testImplementationInnerTypeConstruct() {
    $type = Type::create('Collection', CollectionType::DOCTRINE_ARRAY_COLLECTION, new ObjectType(GClassAdapter::newGClass('Psc\Doctrine\Entity')));
    $this->assertEquals('Doctrine\Common\Collections\ArrayCollection',$type->getClass()->getFQN());
    $this->assertTrue($type->isTyped());
    $this->assertInstanceOf(__NAMESPACE__.'\ObjectType',$type->getType());
    $this->assertEquals('Psc\Doctrine\Entity',$type->getType()->getClassFQN());
    return $type;
  }
  
  /**
   * @depends testImplementationInnerTypeConstruct
   */
  public function testgetPHPType($type) {
    $this->assertEquals('Doctrine\Common\Collections\Collection<Psc\Doctrine\Entity>',$type->getPHPType());
  }

  /**
   * @depends testConstruct
   */
  public function testInterfaced($link) {
    $this->assertInstanceOf(__NAMESPACE__.'\InterfacedType', $link);
    $this->assertTrue(interface_exists($link->getInterface()), 'Interface: '.$link->getInterface().' existiert nicht');
    $this->assertEquals('Doctrine\Common\Collections\Collection', $link->getInterface());
    $this->assertEquals('Doctrine\Common\Collections\Collection', $link->getPHPHint());
  }

  public function createCollectionType() {
    return new CollectionType();
  }
}
