<?php

namespace Webforge\Types\Test;

use Psc\Data\Type\CodeExporter;
use Webforge\Types\Adapters\ComponentMapper;
use Webforge\Types\Type;
use Webforge\Common\ClassUtil;
use Mockery as m;

class TestCase extends \Webforge\Code\Test\Base {

  protected $type;

  public function setUp() {
    parent::setUp();
    $this->mapper = m::mock('Webforge\Types\Adapters\ComponentMapper');
  }

  protected function assertTypeMapsComponent($class, Type $type, $mapper = NULL) {
    if ($mapper) {
      throw new \Exception('This not implemented anymore');
    }

    $this->expectTypeMapsComponent($class, $type);
    $type->getMappedComponent($this->mapper);
  }
  
  protected function expectTypeMapsComponent($class, Type $type) {
    $component = m::mock('Webforge\Types\Adapters\Component');

    $this->mapper->shouldReceive('createComponent')->once()->with(m::on(function($componentName) use ($class) {
      if ($class === 'any') return TRUE;

      $class = ClassUtil::expandNamespace($class, 'Psc\UI\Component');
      $componentClass = ClassUtil::expandNamespace($componentName, 'Psc\UI\Component');

      return $componentClass === $class;
    }))
      ->andReturn($component);

    return $component;
  }
  
  /**
   * Überprüft ob der vom CodeExporter exportierte PHP Code ausgeführt dasselbe ergebnis wieder type hat
   *
   * dies gewährleistet, dass der type so wie er instanziiert, dann exportiert und dann wieder ausgeführt wird derselbe ist wie die Instanz
   */
  protected function assertCodeExportEquals(Type $type) {
    $ce = new CodeExporter();
    
    $phpCode = '$actualType = '.$ce->exportType($type).';';
    eval($phpCode);
    
    if (!isset($actualType)) {
      $this->fail('Evald Code verursachte einen Fehler: '.$phpCode);
    }
    $this->assertEquals($type, $actualType, 'PHPCode ist: '.$phpCode);
  }

  protected function assertObjectType($classFQN, Type $type) {
    $this->assertInstanceOf('Webforge\Types\ObjectType', $type);
    $this->assertEquals($classFQN, $type->getClassFQN(), 'Type ist ein ObjectType aber hat nicht die richtige Klasse');
  }
  
  protected function assertDocType($docType, Type $type) {
    $msg = 'DokumentationsType des Type '.$type.' ist nicht korrekt';
    $this->assertEquals($docType, $type->getName(Type::CONTEXT_DOCBLOCK), $msg);
    $this->assertEquals($docType, $type->getDocType(), $msg);
  }

  protected function assertTypeSerializes($serType, Type $type = NULL) {
    $type = $type ?: $this->type;

    $this->assertInstanceOf('Webforge\Types\SerializationType', $type);

    if ($serType === 'any') {
      $this->assertNotEmpty($type->getSerializationType(), 'should return a serializiationType String');
    } else {
      $this->assertEquals($serType, $type->getSerializationType(), 'serialization type does not match');
    }
  }
}
