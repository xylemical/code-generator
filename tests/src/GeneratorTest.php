<?php

declare(strict_types=1);

namespace Xylemical\Code\Generator;

use PHPUnit\Framework\TestCase;
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

/**
 * Tests \Xylemical\Code\Generator\Generator.
 */
class GeneratorTest extends TestCase {

  /**
   * Tests basic sanity.
   */
  public function testSanity(): void {
    $syntax = new TestSyntax();
    $a = $this->getMockBuilder(StyleInterface::class)->getMock();
    $generator = new Generator($syntax, [$a]);
    $this->assertEquals([$a], $generator->getStyles());

    $b = new TestStyle();
    $generator->addStyle($b);
    $this->assertEquals([$a, $b], $generator->getStyles());
  }

  /**
   * Provides test data for testGenerate().
   *
   * @return array
   *   The test data.
   */
  public function providerTestGenerate(): array {
    return [
      [File::class],
      [Structure::class],
      [Contract::class],
      [Mixin::class],
      [DocumentationInterface::class],
      [Method::class],
      [Parameter::class],
      [Property::class],
      [ElementInterface::class],
      [Constant::class],
      [ExpressionInterface::class],
      [DefinitionInterface::class],
    ];
  }

  /**
   * Test the generation functionality.
   *
   * @codingStandardsIgnoreStart
   *
   * @param class-string<T> $class
   *
   * @template T of \Xylemical\Code\DefinitionInterface
   *
   * @codingStandardsIgnoreEnd
   *
   * @dataProvider providerTestGenerate
   */
  public function testGenerate(string $class): void {
    $generator = new Generator(new TestSyntax(), [new TestStyle()]);
    $object = $this->getMockBuilder($class)
      ->disableOriginalConstructor()
      ->getMock();

    $result = $generator->generate($object);
    $this->assertEquals($class . 'test', $result);
  }

}
