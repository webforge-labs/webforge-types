<?php

namespace Psc\Data\Type;

use Psc\Data\Type\CompositeType;

/**
 * @group class:Psc\Data\Type\CompositeType
 */
class CompositeTypeTest extends CompositeTypeTestCase {
  
  public function setUp() {
    $this->chainClass = 'Psc\Data\Type\CompositeType';
    $this->typeName = 'MyComposite';
  }
  
  public function testMyConstruct() {
    $composite = new \Psc\Data\Type\MyCompositeType();
    $composite = Type::create($this->typeName);
    
    $compositeTyped = new \Psc\Data\Type\MyTypedCompositeType();
    $this->assertEquals('MyType',$compositeTyped->getPHPHint());
    
    return $composite;
  }
  
  public function testDebugReturnsAStringWithAllComponentsAsName() {
    $composite = new CompositeType();
    $composite->setComponents(Type::create('String'), Type::create('Object', new \Psc\Code\Generate\GClass('Psc\Code\AST\LParameter')));
    
    $this->assertEquals('String|Psc\Code\AST\LParameter', $composite->getName(Type::CONTEXT_DEBUG));
  }
  
  public function testAddComponent() {
    $composite1 = new CompositeType();
    $composite1->setComponents($t1 = Type::create('String'),
                               $t2 = Type::create('Object', new \Psc\Code\Generate\GClass('Psc\Code\AST\LParameter'))
                              );
    
    $composite2 = new CompositeType();
    $composite2->addComponent($t1);
    $composite2->addComponent($t2);
    
    $this->assertEquals($composite1, $composite2);
  }

  /**
   * @depends testMyConstruct
   */
  public function testGetMyComponent($composite) {
    $this->assertInstanceOf('Psc\Data\Type\StringType', $composite->getComponent(1));
    $this->assertInstanceOf('Psc\Data\Type\IntegerType', $composite->getComponent(2));
    return $composite;
  }

  /**
   * @depends testGetMyComponent
   */
  public function testSetMyComponents($composite) {
    $this->assertChainable($composite->setComponents(new IntegerType(), new StringType()));
    $this->assertInstanceOf('Psc\Data\Type\IntegerType', $composite->getComponent(1));
    $this->assertInstanceOf('Psc\Data\Type\StringType', $composite->getComponent(2));
    
    return $composite;
  }
  
  /**
   * @depends testMyConstruct
   */
  public function testGetMyComponents($composite) {
    // da wir composite hier per reference übergeben wirkt sich auch testSetMyComponents auf diesen Test aus, ergo sind integer und string vertauscht
    $this->assertEquals(array(1=>new IntegerType(),2=>new StringType()), $composite->getComponents());
    
    $this->assertChainable($composite->setComponents(new StringType(), new IntegerType()));
    $this->assertEquals(array(1=>new StringType(),2=>new IntegerType()), $composite->getComponents());
    return $composite;
  }
}

class MyCompositeType extends CompositeType {
  
  public function __construct() {
    $this->setComponents(new StringType(), new IntegerType());
    parent::__construct();
  }
  
  protected function defineHint() {
    $this->phpHint = NULL; // ungetyped
  }
  
}

class MyTypedCompositeType extends CompositeType {
  
  public function __construct() {
    $this->setComponents(new StringType(), new IntegerType());
    parent::__construct();
  }
  
  protected function defineHint() {
    $this->phpHint = 'MyType';
  }
  
}
?>