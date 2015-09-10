<?php

namespace Webforge\Types;

use Mockery as m;

/**
 * @group class:Webforge\Types\CodeExporter
 */
class CodeExporterTest extends \Webforge\Types\Test\Base {

  public function setUp() {
    $this->chainClass = 'Webforge\Types\CodeExporter';
    parent::setUp();

    $this->codeWriter = new \Webforge\Common\CodeWriter();
    $this->exporter = $this->createCodeExporter();
  }

  public function testConstruct() {
    $this->assertInstanceOf('Webforge\Types\Exporter', $this->createCodeExporter());
  }
  
  public function testExportBaseType() {
    $this->expectExport(
      'new \Webforge\Types\IntegerType()',
      new IntegerType()
    );

    $this->expectExport(
      'new \Webforge\Types\StringType()',
      new StringType()
    );
    
  }
  
  public function testCompositeType() {
    $this->expectExport(
      'new \Webforge\Types\LinkType()',
      new LinkType()
    );
  }
  
  public function testSpecialCaseEnclosingType_i18nType() {
    $this->expectExport(
      "new \Webforge\Types\I18nType(new \Webforge\Types\StringType(), array('de','fr'))",
      new \Webforge\Types\I18nType(new \Webforge\Types\StringType(), array('de','fr'))
    );
  }
  
  public function testExportEnclosingType() {
    $this->expectExport(
      'new \Webforge\Types\ArrayType(new \Webforge\Types\IntegerType())',
      new \Webforge\Types\ArrayType(new IntegerType())
    );

    $this->expectExport(
      "new \Webforge\Types\CollectionType(\Webforge\Types\CollectionType::WEBFORGE_COLLECTION, new \Webforge\Types\ObjectType(new \Psc\Code\Generate\GClass('Psc\\\\CMS\\\\SpecialEntity')))",
      new \Webforge\Types\CollectionType(CollectionType::WEBFORGE_COLLECTION, new \Webforge\Types\ObjectType(GClassAdapter::newGClass('Psc\CMS\SpecialEntity')))
    );
    
    $this->expectExport(
      "new \Webforge\Types\PersistentCollectionType(new \Psc\Code\Generate\GClass('Psc\\\\CMS\\\\SpecialEntity'))",
      new \Webforge\Types\PersistentCollectionType(GClassAdapter::newGClass('Psc\CMS\SpecialEntity'))
    );

    $this->expectExport(
      "new \Webforge\Types\PersistentCollectionType(new \Psc\Code\Generate\GClass('Psc\\\\CMS\\\\NormalEntity'), \Webforge\Types\CollectionType::PSC_ARRAY_COLLECTION)",
      new \Webforge\Types\PersistentCollectionType(GClassAdapter::newGClass('Psc\CMS\NormalEntity'), CollectionType::PSC_ARRAY_COLLECTION)
    );
  }

  protected function expectExport($code, Type $type) {
    $this->assertEquals($code, $this->exporter->exportType($type));
  }

  public function createCodeExporter() {
    return new CodeExporter($this->codeWriter);
  }
}
