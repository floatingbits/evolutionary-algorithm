<?php


namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Mutation;


use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\IntSymbolFactory;
use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotype;
use FloatingBits\EvolutionaryAlgorithm\Mutation\SimpleSymbolArrayMutator;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BooleanRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use PHPUnit\Framework\TestCase;

class SimpleSymbolArrayGenotypeMutatorTest extends TestCase
{
    public function testMutate() {

        $intRandomizer = $this->createMock(IntRandomizer::class);

        $firstGeneValue = 12;
        $secondGeneValue = 10;
        $thirdGeneValue = 15;
        $mutatedGeneValue = 5;
        $intRandomizer->method('randomInt')
            ->willReturnOnConsecutiveCalls($firstGeneValue, $secondGeneValue, $thirdGeneValue, $mutatedGeneValue);

        /** @var SymbolArrayGenotype<int> $genotype */
        $genotype = new SymbolArrayGenotype(new IntSymbolFactory($intRandomizer));
        $genotype->initialize(3);
        $booleanRandomizer = $this->createMock(BooleanRandomizer::class);
        $booleanRandomizer->method('randomYesOrNo')
            ->willReturnOnConsecutiveCalls(false, true, false);

        $mutator = new SimpleSymbolArrayMutator($booleanRandomizer);
        $mutator->mutate($genotype);

        $this->assertEquals($genotype->getSymbolAt(0)->getValue(), $firstGeneValue);
        $this->assertEquals($genotype->getSymbolAt(1)->getValue(), $mutatedGeneValue);
        $this->assertEquals($genotype->getSymbolAt(2)->getValue(), $thirdGeneValue);
    }
}