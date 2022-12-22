<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Evaluation;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\StringCompareEvaluator;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\StringPhenotype;
use PHPUnit\Framework\TestCase;

class StringCompareEvaluatorTest extends TestCase
{
    public function testEvaluatePerfect() {
        $testString = 'Hello World';

        $evaluator = new StringCompareEvaluator($testString);

        $stringPhenotype = $this->createMock(StringPhenotype::class);
        $stringPhenotype->method('getString')->willReturn($testString);
        $score = $evaluator->evaluate($stringPhenotype)->getMainFitness();
        $this->assertEquals(strlen($testString), $score);
    }
    public function testEvaluateClose() {
        $testString = 'Hello World';
        $compareString = 'Hello Workw';

        $evaluator = new StringCompareEvaluator($testString);

        $stringPhenotype = $this->createMock(StringPhenotype::class);
        $stringPhenotype->method('getString')->willReturn($compareString);
        $score = $evaluator->evaluate($stringPhenotype)->getMainFitness();
        $this->assertEquals(strlen($testString) - 2, $score);

    }

}