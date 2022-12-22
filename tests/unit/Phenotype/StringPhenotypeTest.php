<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Phenotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SimpleSymbol;
use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\StringSymbolFactory;
use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotype;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\StringPhenotype;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\StringRandomizer;
use PHPUnit\Framework\TestCase;

class StringPhenotypeTest extends TestCase
{
    public function testString() {
        $factory = new StringSymbolFactory(new StringRandomizer());
        $genotype = new SymbolArrayGenotype($factory);
        $genotype = $this->createMock(SymbolArrayGenotype::class);
        $genotype->method('getSymbolAt')->willReturnOnConsecutiveCalls(
            new SimpleSymbol('a'), new SimpleSymbol('b'), new SimpleSymbol('c')
        );

        $genotype->method('getSymbolLength')->willReturn(3);
        $phenotype = new StringPhenotype($genotype);
        $string = $phenotype->getString();

        $this->assertEquals('abc', $string);
    }
}