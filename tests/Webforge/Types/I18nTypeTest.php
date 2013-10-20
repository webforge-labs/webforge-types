<?php

namespace Webforge\Types;

class I18nTypeTest extends \Webforge\Types\Test\TestCase {
  
  protected $i18nType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\I18nType';
    parent::setUp();
    $this->innerType= Type::create('String');
    $this->i18nType = new I18nType($this->innerType, $this->languages = array('de','fr'));
  }
  
  public function testMappedComponent() {
    $component = $this->expectTypeMapsComponent('I18nWrapper', $this->i18nType);

    $component->shouldReceive('dpi')->with($this->innerType, $this->languages, $this->mapper)->once();

    $this->i18nType->getMappedComponent($this->mapper);
  }
}
