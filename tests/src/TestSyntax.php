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
use Xylemical\Token\Token;
use Xylemical\Token\TokenStream;
use Xylemical\Token\TokenStreamInterface;

/**
 * Provides a test syntax generator.
 */
class TestSyntax implements SyntaxInterface {

  /**
   * {@inheritdoc}
   */
  public function getFile(File $file): TokenStreamInterface {
    return $this->doDefinition(File::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getStructure(Structure $structure): TokenStreamInterface {
    return $this->doDefinition(Structure::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getContract(Contract $contract): TokenStreamInterface {
    return $this->doDefinition(Contract::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getMixin(Mixin $mixin): TokenStreamInterface {
    return $this->doDefinition(Mixin::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getDocumentation(DocumentationInterface $documentation): TokenStreamInterface {
    return $this->doDefinition(DocumentationInterface::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getMethod(Method $method): TokenStreamInterface {
    return $this->doDefinition(Method::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getParameter(Parameter $parameter): TokenStreamInterface {
    return $this->doDefinition(Parameter::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getProperty(Property $property): TokenStreamInterface {
    return $this->doDefinition(Property::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getElement(ElementInterface $element): TokenStreamInterface {
    return $this->doDefinition(ElementInterface::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getConstant(Constant $constant): TokenStreamInterface {
    return $this->doDefinition(Constant::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getExpression(ExpressionInterface $expression): TokenStreamInterface {
    return $this->doDefinition(ExpressionInterface::class);
  }

  /**
   * {@inheritdoc}
   */
  public function getDefinition(DefinitionInterface $definition): TokenStreamInterface {
    return $this->doDefinition(DefinitionInterface::class);
  }

  /**
   * Create a token stream with a token valued as class.
   *
   * @param string $class
   *   The class.
   *
   * @return \Xylemical\Token\TokenStreamInterface
   *   The token stream.
   */
  protected function doDefinition(string $class): TokenStreamInterface {
    return new TokenStream([new Token('token', $class)]);
  }

}
