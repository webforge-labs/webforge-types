<?php

namespace Webforge\Types;

use Webforge\Types\Exporter;
use Webforge\Common\CodeWriter;
use Webforge\Common\ClassInterface;

/**
 * Exportiert den Type so, dass er als PHP Code ausgeführt werden kann und dann wieder der gleiche Type ist (nicht identisch)
 *
 * dies brauchen wir z. B. beim Serialisieren von Types für den EntityBuilder
 */
class CodeExporter implements \Webforge\Types\Exporter {
  
  protected $codeWriter;
  
  public function __construct(CodeWriter $codeWriter) {
    $this->codeWriter = $codeWriter;
  }
  
  public function exportType(Type $type) {
    
    if ($type instanceof PersistentCollectionType) {
      return $this->codeWriter->writeConstructor(
        $type->getTypeClass(),
        // "purer" php code
        $this->exportGClass($type->getType()->getClass())
      );

    } elseif ($type instanceof CollectionType) {
      $implementationParameter = $type->getImplementationConstantCode();
      
      return $this->codeWriter->writeConstructor(
        $type->getTypeClass(),

        // "purer" php code
        $implementationParameter.
        ($type->isTyped() ? ', '.$this->exportType($type->getType()) : NULL)
      );


    } elseif ($type instanceof I18nType) { // bla, blöder sonderfall, obwohl eigentlich enclosingType
      return $this->codeWriter->writeConstructor(
        $type->getTypeClass(),
        ($type->isTyped() ? $this->exportType($type->getType()) : NULL).', '.
        $this->codeWriter->exportList($type->getLanguages())
      );
      
    } elseif ($type instanceof EnclosingType) {
      // alle construktoren mit 1 parameter der der innere type ist
      return $this->codeWriter->writeConstructor(
        $type->getTypeClass(),
        ($type->isTyped() ? $this->exportType($type->getType()) : NULL)
      );
      
    } elseif ($type instanceof DateTimeType) {
      return $this->codeWriter->writeConstructor($type->getTypeClass(), NULL);
  
    // @TODO das hier zu einem Interface zusammenfaccen (GClassed Type?)
    } elseif ($type instanceof ObjectType) {
      return $this->codeWriter->writeConstructor(
        $type->getTypeClass(),
        ($type->hasClass() ? $this->exportGClass($type->getClass()) : NULL)
      );
    } elseif($type instanceof DCEnumType) {
      return $this->codeWriter->writeConstructor(
        $type->getTypeClass(),
        ($type->hasClass() ? $this->exportGClass($type->getClass()) : NULL).','.
        $this->codeWriter->exportFunctionParameters(array($type->exportLabels()))
      );
      
    } elseif ($type instanceof CompositeType || $type instanceof Type) {
      // alle anderen konstruktoren ohne parameter
      return $this->codeWriter->writeConstructor($type->getTypeClass(), NULL);
    }
    
    //throw new TypeException('Kann '.$type->getName().' nicht als PHP-Code exportieren');
  }
  
  protected function exportGClass(ClassInterface $gClass) {
    return $this->codeWriter->exportConstructor(GClassAdapter::newGClass('Psc\Code\Generate\GClass'), array($gClass->getFQN()));
  }
}
