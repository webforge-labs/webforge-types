<?php

namespace Webforge\Types;

use Webforge\Types\SmallIntegerType;

/**
 * @group class:Webforge\Types\SmallIntegerType
 */
class SmallIntegerTypeTest extends IntegerTypeTestCase {

  public function testConstruct() {
    // wir müssen hier nicht parent aufrufen, das macht der IntegerTest schon selbst
    
    $type = new SmallIntegerType(); // lässt den TestCase mit unserem Constructor durchlaufen
    return $type;
  }
}
