<?php

declare(strict_types=1);

namespace Xylemical\Code\Generator;

use Xylemical\Code\Definition\Constant;
use Xylemical\Code\Definition\Contract;
use Xylemical\Code\Definition\ElementInterface;
use Xylemical\Code\Definition\File;
use Xylemical\Code\Definition\Method;
use Xylemical\Code\Definition\Mixin;
use Xylemical\Code\Definition\Parameter;
use Xylemical\Code\Definition\Property;
use Xylemical\Code\Definition\Structure;
use Xylemical\Code\DefinitionInterface;
use Xylemical\Code\DocumentationInterface;
use Xylemical\Code\ExpressionInterface;
use Xylemical\Token\TokenStreamInterface;

/**
 * Provides a generic generator.
 */
class Generator implements GeneratorInterface {

  /**
   * The styles to apply.
   *
   * @var \Xylemical\Code\Generator\StyleInterface[]
   */
  protected array $styles = [];

  /**
   * The syntax generation.
   *
   * @var \Xylemical\Code\Generator\SyntaxInterface
   */
  protected SyntaxInterface $syntax;

  /**
   * Generator constructor.
   *
   * @param \Xylemical\Code\Generator\SyntaxInterface $syntax
   *   The syntax generator.
   * @param \Xylemical\Code\Generator\StyleInterface[] $styles
   *   The styles to apply.
   */
  public function __construct(SyntaxInterface $syntax, array $styles = []) {
    $this->syntax = $syntax;
    foreach ($styles as $style) {
      $this->addStyle($style);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getStyles(): array {
    return $this->styles;
  }

  /**
   * {@inheritdoc}
   */
  public function addStyle(StyleInterface $style): static {
    $this->styles[] = $style;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function generate(DefinitionInterface $definition): string {
    $stream = $this->doGeneration($definition);

    // Apply the styles.
    foreach ($this->styles as $style) {
      $stream = $style->apply($stream);
    }

    // Convert the token stream into a string.
    return (string) $stream;
  }

  /**
   * Perform the generation dependent on class.
   *
   * @param \Xylemical\Code\DefinitionInterface $definition
   *   The definition.
   *
   * @return \Xylemical\Token\TokenStreamInterface
   *   The token stream.
   */
  protected function doGeneration(DefinitionInterface $definition): TokenStreamInterface {
    return match (TRUE) {
      $definition instanceof File => $this->syntax->getFile($definition),
      $definition instanceof Structure => $this->syntax->getStructure($definition),
      $definition instanceof Mixin => $this->syntax->getMixin($definition),
      $definition instanceof Contract => $this->syntax->getContract($definition),
      $definition instanceof Constant => $this->syntax->getConstant($definition),
      $definition instanceof Method => $this->syntax->getMethod($definition),
      $definition instanceof Property => $this->syntax->getProperty($definition),
      $definition instanceof Parameter => $this->syntax->getParameter($definition),
      $definition instanceof DocumentationInterface => $this->syntax->getDocumentation($definition),
      $definition instanceof ElementInterface => $this->syntax->getElement($definition),
      $definition instanceof ExpressionInterface => $this->syntax->getExpression($definition),
      default => $this->syntax->getDefinition($definition),
    };
  }

}
