<?php

namespace Webforge\Types;

use Webforge\Types\ArrayType;

/**
 * @group class:Webforge\Types\ArrayType
 */
class ArrayTypeTest extends \Webforge\Types\Test\Base {

  public function testConstruct() {
    $array = new ArrayType();
    
    $this->assertFalse($array->isTyped());
    
    $typedArray = new ArrayType($it = new IntegerType());
    $this->assertTrue($typedArray->isTyped());
    $this->assertSame($it, $typedArray->getType());
    
    return $typedArray;
  }
  
  public function testThatIsListIsNotSetAfterConstruct() {
    $type = new ArrayType();
    $this->assertSame(NULL, $type->isList()); // means: no decision was met!
    $this->assertSame(NULL, $type->setIsList(NULL)->isList());
  }
  
  /**
   * @depends testConstruct
   */
  public function testSetAndGetType(ArrayType $typedArray) {
    $it = $typedArray->getType();
    $this->assertInstanceOf('Webforge\Types\IntegerType',$it); // doppelt gemoppelt von testConstruct
    
    $typedArray->setType($it);
    $this->assertTrue($typedArray->isTyped());
    $this->assertSame($it, $typedArray->getType());
    
    $typedArray->setType(NULL);
    $this->assertFalse($typedArray->isTyped());
    return $typedArray; // ist nicht mehr wirklich typed
  }
  
  /**
   * @depends testSetAndGetType
   * @expectedException Webforge\Types\ArrayNotTypedException
   */
  public function testGetTypeThrowsArrayNotTypedExceptionWhenTypeisNULL(ArrayType $array) {
    $array->getType();
  }
  
  public function testIsParameterHintedType() {
    $array = new ArrayType();
    
    $this->assertInstanceOf('Webforge\Types\ParameterHintedType', $array);
    $this->assertEquals('Array', $array->getParameterHint($useFQN = TRUE));
    $this->assertEquals('Array', $array->getParameterHint($useFQN = FALSE));
    
    $this->assertNull($array->getParameterHintImport());
  }
}
