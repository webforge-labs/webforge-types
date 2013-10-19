<?php

namespace Webforge\Types;

use Webforge\Types\Exporter;
use Psc\Code\Generate\CodeWriter;

/**
 * Exportiert den Type so, dass er als PHP Code ausgeführt werden kann und dann wieder der gleiche Type ist (nicht identisch)
 *
 * dies brauchen wir z. B. beim Serialisieren von Types für den EntityBuilder
 */
class CodeExporter extends \Psc\SimpleObject implements \Webforge\Types\Exporter {
  
  protected $codeWriter;
  
  public function __construct(CodeWriter $codeWriter = NULL) {
    $this->codeWriter = $codeWriter ?: new CodeWriter();
  }
  
  public function exportType(Type $type) {
    
    if ($type instanceof PersistentCollectionType) {
      return $this->codeWriter->writeConstructor(
                                                 $type->getTypeClass(),
                                                 // "purer" php code
                                                 $this->exportGClass($type->getType()->getClass())
                                                );

    } elseif ($type instanceof CollectionType) {
      $implementation = $type->getClass()->getFQN();
      if (CollectionType::PSC_ARRAY_COLLECTION === $implementation) {
        $implementation = '\Webforge\Types\CollectionType::PSC_ARRAY_COLLECTION';
      } elseif (CollectionType::DOCTRINE_ARRAY_COLLECTION === $implementation) {
        $implementation = '\Webforge\Types\CollectionType::DOCRTRINE_ARRAY_COLLECTION';
      } else {
        $implementation = '\\'.$implementation;
      }
      
      return $this->codeWriter->writeConstructor(
                                                 $type->getTypeClass(),
                                                 // "purer" php code
                                                 $implementation.
                                                 ($type->isTyped() ? ', '.$this->exportType($type->getType()) : NULL)
                                                );


    } elseif ($type instanceof I18nType) { // bla, blöder sonderfall, obwohl eigentlich enclosingType
      return $this->codeWriter->writeConstructor($type->getTypeClass(),
                                                 ($type->isTyped() ? $this->exportType($type->getType()) : NULL).', '.
                                                 $this->codeWriter->exportList($type->getLanguages())
                                                );
      
    } elseif ($type instanceof EnclosingType) {
      // alle construktoren mit 1 parameter der der innere type ist
      return $this->codeWriter->writeConstructor($type->getTypeClass(),
                                                 ($type->isTyped() ? $this->exportType($type->getType()) : NULL)
                                                );
      
    } elseif ($type instanceof DateTimeType) {
      return $this->codeWriter->writeConstructor($type->getTypeClass(), NULL);
  
    // @TODO das hier zu einem Interface zusammenfaccen (GClassed Type?)
    } elseif ($type instanceof ObjectType) {
      return $this->codeWriter->writeConstructor($type->getTypeClass(),
                                                 ($type->hasClass() ? $this->exportGClass($type->getClass()) : NULL)
                                                );
    } elseif($type instanceof DCEnumType) {
      return $this->codeWriter->writeConstructor($type->getTypeClass(),
                                                 ($type->hasClass() ? $this->exportGClass($type->getClass()) : NULL).','.
                                                 $this->codeWriter->exportFunctionParameters(array($type->exportLabels()))
                                                );
      
    } elseif ($type instanceof CompositeType || $type instanceof Type) {
      // alle anderen konstruktoren ohne parameter
      return $this->codeWriter->writeConstructor($type->getTypeClass(), NULL);
    }
    
    //throw new TypeException('Kann '.$type->getName().' nicht als PHP-Code exportieren');
  }
  
  protected function exportGClass(GClass $gClass) {
    return $this->codeWriter->exportConstructor(GClassAdapter::newGClass('Psc\Code\Generate\GClass'), array($gClass->getFQN()));
  }
}
