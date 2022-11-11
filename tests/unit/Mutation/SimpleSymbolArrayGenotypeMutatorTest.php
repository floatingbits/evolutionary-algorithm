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

        $genotype = new SymbolArrayGenotype(new IntSymbolFactory($intRandomizer));
        $genotype->initialize(3);
        $booleanRandomizer = $this->createMock(BooleanRandomizer::class);
        $booleanRandomizer->method('randomYesOrNo')
            ->willReturnOnConsecutiveCalls(false, true, false);

        $mutator = new SimpleSymbolArrayMutator($booleanRandomizer);
        $genotype = $mutator->mutate($genotype);

        $this->assertEquals($firstGeneValue, $genotype->getSymbolAt(0)->getValue());
        $this->assertEquals($mutatedGeneValue, $genotype->getSymbolAt(1)->getValue());
        $this->assertEquals($thirdGeneValue, $genotype->getSymbolAt(2)->getValue());
    }
}