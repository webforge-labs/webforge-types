<?php

namespace Webforge\Types;

/**
 * @group class:Webforge\Types\I18nType
 */
class I18nTypeTest extends \Webforge\Types\TestCase {
  
  protected $i18nType;
  
  public function setUp() {
    $this->chainClass = 'Webforge\Types\I18nType';
    parent::setUp();
    $this->i18nType = new I18nType(Type::create('String'), array('de','fr'));
  }
  
  public function testMappedComponent() {
    $component = $this->assertTypeMapsComponent('I18nWrapper', $this->i18nType);
    
    $this->assertEquals(array('de','fr'), $component->getLanguages());
  }
}
