<?php

declare(strict_types=1);

namespace Xylemical\Code\Generator;

use Xylemical\Code\DefinitionInterface;

/**
 * Generates code from a definition and style.
 */
interface GeneratorInterface {

  /**
   * Get the styles that will apply to the definition.
   *
   * @return \Xylemical\Code\Generator\StyleInterface[]
   *   The styles.
   */
  public function getStyles(): array;

  /**
   * Add a style to the generation.
   *
   * @param \Xylemical\Code\Generator\StyleInterface $style
   *   The style.
   *
   * @return $this
   */
  public function addStyle(StyleInterface $style): static;

  /**
   * Generates code based on the definition.
   *
   * @param \Xylemical\Code\DefinitionInterface $definition
   *   The definition.
   *
   * @return string
   *   The generated code.
   */
  public function generate(DefinitionInterface $definition): string;

}
