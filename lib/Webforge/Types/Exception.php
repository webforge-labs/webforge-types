<?php

namespace Webforge\Types;

use InvalidArgumentException;
use Webforge\Common\Util as Code;

class Exception extends \Webforge\Common\Exception {

  /**
   *
   * @param integer $num 1-based
   * @param string $context Class::Method()|Method()|something parseable
   * @param mixed $actual
   * @param Webforge\Types\Type $expected
   * @return InvalidArgumentException
   */
  public static function invalidArgument($num, $context, $actual, Type $expected) {
    return new InvalidArgumentException(
      sprintf('Argument %d passed to %s must be a %s, %s given', $num, $context, $expected->getName(Type::CONTEXT_DEBUG), Code::varInfo($actual))
    );
  }
}
