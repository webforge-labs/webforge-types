<?php

namespace Webforge\Types;

/**
 * Ein Wrapper, der die innere Komponente in mehrere Sprachen übersetzen kann
 */
class I18nType extends ArrayType implements MappedComponentType {
  
  /**
   * @var array
   */
  protected $languages;
  
  /**
   * @param Type $type der Typ des Properties welches Internationalisiert werden soll
   */
  public function __construct(Type $type, Array $languages) {
    $this->languages = $languages;
    parent::__construct($type, $list = FALSE); // es ist immer ein assoziativer array / hashmap! weil $language=>$languageValue
  }
  
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper
      ->createComponent('I18nWrapper')
        ->dpi($this->getType(), $this->languages, $componentMapper);
  }
  
  /**
   * @param array $languages
   */
  public function setLanguages(Array $languages) {
    $this->languages = $languages;
    return $this;
  }
  
  /**
   * @return array
   */
  public function getLanguages() {
    return $this->languages;
  }
}
