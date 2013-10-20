<?php

namespace Webforge\Types;

use Psc\Code\Code;
use Psc\Code\Generate\GClass;
use Webforge\Common\ClassInterface;
use InvalidArgumentException;

class CollectionType extends \Webforge\Types\InterfacedObjectType implements MappedComponentType, TraversableType {
  
  const PSC_ARRAY_COLLECTION = 'Psc\Data\ArrayCollection';
  const WEBFORGE_COLLECTION = 'Webforge\Collections\ArrayCollection';
  const DOCTRINE_ARRAY_COLLECTION = 'Doctrine\Common\Collections\ArrayCollection';

  /**
   * @var bool|NULL
   */
  protected $isList = NULL;

  protected $implementation;
  
  /**
   * @param const $implementation
   */
  public function __construct($implementation = NULL, Type $innerType = NULL) {
    if (!($implementation instanceof ClassInterface) && $implementation !== NULL) {
      
      if ($implementation != self::PSC_ARRAY_COLLECTION && $implementation != self::DOCTRINE_ARRAY_COLLECTION && $implementation != self::WEBFORGE_COLLECTION) {
         throw new InvalidArgumentException("implementation needs to be of _COLLECTION constant");
      }

      $implementation = GClassAdapter::newGClass($implementation);
    }

    $this->implementation = $implementation;
    
    parent::__construct($implementation);
    
    if (isset($innerType)) {
      $this->setType($innerType);
    }
  }

  public function getImplementationConstantCode() {
    if (!isset($this->implementation)) return 'NULL';

    $impl = $this->implementation->getFQN();

    if (self::PSC_ARRAY_COLLECTION === $impl) {
      return '\\'.__CLASS__.'::PSC_ARRAY_COLLECTION';
    } elseif (self::DOCTRINE_ARRAY_COLLECTION === $impl) {
      return  '\\'.__CLASS__.'::DOCTRINE_ARRAY_COLLECTION';
    } elseif (self::WEBFORGE_COLLECTION === $impl) {
      return  '\\'.__CLASS__.'::WEBFORGE_COLLECTION';
    } else {
      return '\\'.$this->implementation;
    }
  }
  
  /**
   * Collection zu Component-Mapping
   *
   */
  public function getMappedComponent(\Webforge\Types\Adapters\ComponentMapper $componentMapper) {
    return $componentMapper->createComponent('ComboDropBox');
  }
  

  /**
   * @return bool
   */
  public function isTyped() {
    return isset($this->type);
  }
  
  /**
   * @return Webforge\Types\Type
   */
  public function getType() {
    if (!isset($this->type)) throw new NotTypedException('Cannot return Type of Collection. Because its not set.');
    return $this->type;
  }
  
  
  /**
   *
   * wird der Parameter NULL Übergeben ist der Array nicht mehr getyped
   * @param Webforge\Types\Type|NULL
   */
  public function setType(Type $type = NULL) {
    $this->type = $type;
    return $this;
  }
  
  /**
   * Gibt den PHP-DokumentationsTyp der Collection zurück
   *
   * Doctrine\Common\Collections\Collection<Psc\Doctrine\Entity> z. B.
   */
  public function getPHPType() {
    return $this->getInterface().($this->isTyped() ? sprintf('<%s>',$this->getType()->getPHPType()) : NULL);
  }
  
  public function getInterface() {
    return 'Doctrine\Common\Collections\Collection';
    
    // das geht leider nicht, weil wir dann die doctrine arraycollection nicht als implementierung benutzen können
    // yagni?
    return $this->getInterfaceDefinition('Collection');
  }

  public function getDefaultValue() {
    // beide collectio interfaces lassen sich mit new und einem leeren array erstellen
    $c = $this->getClassFQN();
    return new $c(array());
  }

  public function hasScalarDefaultValue() {
    return FALSE;
  }
  

  /**
   * @return bool|NULL wenn es === NULL ist, gibt es keine Aussage explizite Aussage darüber ob das Array eine Liste ist
   */
  public function isList() {
    return $this->isList;
  }
  
  /**
   * @param bool $list
   */
  public function setIsList($list) {
    $this->isList = $list == TRUE;
    return $this;
  }
}
