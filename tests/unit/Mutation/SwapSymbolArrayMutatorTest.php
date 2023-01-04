<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Mutation;

use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\IntSymbolFactory;
use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotype;
use FloatingBits\EvolutionaryAlgorithm\Mutation\SwapSymbolArrayMutator;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizerInterface;
use PHPUnit\Framework\TestCase;

class SwapSymbolArrayMutatorTest extends TestCase
{
    public function testSimpleSwap() {

        $randomizer = $this->createMock(ConfigurableIntRandomizerInterface::class);
        $randomizer->method('randomInt')->willReturnOnConsecutiveCalls(1,2);

        $swapMutator = new SwapSymbolArrayMutator(0.25, $randomizer);

        $symbolRandomizer = $this->createMock(IntRandomizerInterface::class);
        $symbolRandomizer->method('randomInt')->willReturnOnConsecutiveCalls(1,2,3,4);
        $symbolFactory = new IntSymbolFactory($symbolRandomizer);

        $genotype = new SymbolArrayGenotype($symbolFactory);
        $genotype->initialize(4);

        $newGenotype = $swapMutator->mutate($genotype);

        $this->assertEquals(1, $newGenotype->getSymbolAt(0)->getValue());
        $this->assertEquals(3, $newGenotype->getSymbolAt(1)->getValue());
        $this->assertEquals(2, $newGenotype->getSymbolAt(2)->getValue());
        $this->assertEquals(4, $newGenotype->getSymbolAt(3)->getValue());
    }
}