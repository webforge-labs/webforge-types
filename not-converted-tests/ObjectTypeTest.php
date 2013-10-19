<?php

namespace Webforge\Types;

use Webforge\Types\ObjectType;
use Psc\Code\Generate\GClass;

/**
 * @group class:Webforge\Types\ObjectType
 */
class ObjectTypeTest extends \Webforge\Types\Test\Base {
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\ObjectType';
  }
  
  public function testConstruct() {
    $type = new ObjectType(); // Ok
    
    $type = new ObjectType($gc = GClassAdapter::newGClass('stdClass'));
    $this->assertSame($gc, $type->getClass());
  }
  
  public function testExpandNamespaceWithNoFQN() {
    $type = new ObjectType(GClassAdapter::newGClass('LParameter'));
    $type->expandNamespace('Psc\Code\AST');
    
    $this->assertEquals('Psc\Code\AST\LParameter', $type->getClassFQN());
  }
  
  public function testExpandNamespaceWithFQN() {
    $type = new ObjectType($gc = GClassAdapter::newGClass('\LParameter'));
    $type->expandNamespace('Psc\Code\AST');
    $this->assertEquals('LParameter', $type->getClassFQN());
  }

  public function testSetAndGetClass() {
    $type = new ObjectType();
    
    $this->assertChainable($type->setClass($nc = GClassAdapter::newGClass('Psc\Data\Set')));
    $this->assertInstanceOf('Psc\Code\Generate\GClass',$gc = $type->getClass());
    $this->assertSame($nc, $gc);
  }
  
  public function testPHPType() {
    $type = Type::create('Object')->setClass(GClassAdapter::newGClass('Psc\Data\Set'));
    
    $this->assertEquals('Psc\Data\Set',$type->getPHPType());
  }

  public function testPHPHint() {
    $type = Type::create('Object')->setClass(GClassAdapter::newGClass('Psc\Data\Set'));
    
    $this->assertEquals('\Psc\Data\Set',$type->getPHPHint());
  }

  public function testPHPHintWithoutClass() {
    $type = Type::create('Object');
    
    $this->assertEquals('\stdClass', $type->getPHPHint());
  }
  
  public function testPHPHintWithNamespaceContext() {
    $type = Type::create('Object')->setClass(GClassAdapter::newGClass('Webforge\Common\System\Dir'));
    
    $this->assertEquals('Dir',$type->getPHPHint('Webforge\Common\System'));
  }

  public function testIsParameterHintedTypeForTypeWithGClass() {
    $type = Type::create('Object')->setClass($gClass = GClassAdapter::newGClass('Webforge\Common\System\Dir'));
    
    $this->assertInstanceOf('Webforge\Types\ParameterHintedType', $type);
    $this->assertEquals('\Webforge\Common\System\Dir', $type->getParameterHint($useFQN = TRUE));
    $this->assertEquals('Dir', $type->getParameterHint($useFQN = FALSE));
    
    $this->assertSame($gClass, $type->getParameterHintImport());
  }
  
  public function testIsParameterHintedTypeForType() {
    $type = Type::create('Object');
    
    $this->assertInstanceOf('Webforge\Types\ParameterHintedType', $type);
    $this->assertEquals('\stdClass', $type->getParameterHint($useFQN = TRUE));
    $this->assertEquals('stdClass', $type->getParameterHint($useFQN = FALSE));
    
    $this->assertNull($type->getParameterHintImport());
  }
}
?>