<?php

namespace Webforge\Types;

use Webforge\Types\ImageType;

/**
 * @group class:Webforge\Types\ImageType
 */
class ImageTypeTest extends \Webforge\Types\Test\Base {

  public function testConstruct() {
    $imageType = new ImageType();
    $this->assertEquals('Image',$imageType->getName());
  }
}
