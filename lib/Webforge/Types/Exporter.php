<?php

namespace Webforge\Types;

/**
 * Ein Exportert wandelt einen Typ in ein bestimmtes Format um
 *
 * z. B.
 *  - zum Doctrine(Datenbank)Datentyp
 *  - zum PHP DokumentationsTyp
 *  - zum ausführbaren PHP Code, um den Typ compilen zu können
 */
interface Exporter {
  
  public function exportType(Type $type);
  
}
