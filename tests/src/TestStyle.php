<?php

declare(strict_types=1);

namespace Xylemical\Code\Generator;

use Xylemical\Token\Token;
use Xylemical\Token\TokenStreamInterface;

/**
 * Provides a test style to manipulate the token stream.
 */
class TestStyle implements StyleInterface {

  /**
   * {@inheritdoc}
   */
  public function apply(TokenStreamInterface $stream): TokenStreamInterface {
    $stream->addToken(new Token('style', 'test'));
    return $stream;
  }

}
