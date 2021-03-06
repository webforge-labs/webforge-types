<?php

namespace Webforge\Types;

class CollectionTypeTest extends Test\TestCase {

  public function setUp() {
    $this->chainClass = 'Webforge\Types\CollectionType';
    parent::setUp();
    $this->type = Type::create('Collection');
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

  public function testHasASerializationType() {
    $this->assertTypeSerializes('ArrayCollection');
  }
  
  /**
   * @depends testImplementationInnerTypeConstruct
   */
  public function testgetPHPType($type) {
    $this->assertEquals('Doctrine\Common\Collections\Collection<Psc\Doctrine\Entity>',$type->getPHPType());
  }

  public function testInterfaced() {
    $link = $this->type;
    $this->assertInstanceOf(__NAMESPACE__.'\InterfacedType', $link);
    $this->assertTrue(interface_exists($link->getInterface()), 'Interface: '.$link->getInterface().' existiert nicht');
    $this->assertEquals('Doctrine\Common\Collections\Collection', $link->getInterface());
    $this->assertEquals('Doctrine\Common\Collections\Collection', $link->getPHPHint());
  }

  public function createCollectionType() {
    return new CollectionType();
  }
}
