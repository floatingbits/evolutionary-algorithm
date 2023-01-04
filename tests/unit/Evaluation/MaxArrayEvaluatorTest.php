<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Evaluation;



use FloatingBits\EvolutionaryAlgorithm\Evaluation\MaxArrayEvaluator;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\FloatArrayPhenotypeInterface;
use PHPUnit\Framework\TestCase;

class MaxArrayEvaluatorTest extends TestCase
{
    public function testInvertSign() {
        $evaluator = new MaxArrayEvaluator(true);
        $arrayPhenotype = $this->createMock(FloatArrayPhenotypeInterface::class);
        $testValue = 1;
        $arrayPhenotype->method('getArray')->willReturn([$testValue]);
        $score = $evaluator->evaluate($arrayPhenotype)->getMainFitness();
        $this->assertEquals(-$testValue, $score);
    }

    public function testSimpleArray() {
        $evaluator = new MaxArrayEvaluator(false);
        $arrayPhenotype = $this->createMock(FloatArrayPhenotypeInterface::class);
        $arrayPhenotype->method('getArray')->willReturn([1,2,3]);
        $score = $evaluator->evaluate($arrayPhenotype)->getMainFitness();
        $this->assertEquals(3, $score);
    }
}