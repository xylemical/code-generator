<?php

declare(strict_types=1);

namespace Xylemical\Code\Generator;

use Xylemical\Token\TokenStreamInterface;

/**
 * Applies code styles to a token stream.
 */
interface StyleInterface {

  /**
   * Applies code styling to a token stream.
   *
   * @param \Xylemical\Token\TokenStreamInterface $stream
   *   The token stream.
   *
   * @return \Xylemical\Token\TokenStreamInterface
   *   The updated token stream.
   */
  public function apply(TokenStreamInterface $stream): TokenStreamInterface;

}
