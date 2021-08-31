<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Recombination;

use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\IntSymbolFactory;
use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SimpleSymbol;
use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotype;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BooleanRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Recombination\SymbolArrayCrossoverRecombinator;
use PHPUnit\Framework\TestCase;

class SymbolArrayCrossoverRecombinatorTest extends TestCase
{
    public function testRecombine() {
        $intRandomizer = $this->createMock(IntRandomizer::class);
        $booleanRandomizr = $this->createMock(BooleanRandomizer::class);
        $booleanRandomizr->method('randomYesOrNo')->willReturn(true);//Combined genotype starts with first
        $intRandomizer->method('randomInt')->willReturnOnConsecutiveCalls(2,1);//First Crossover after 2 Symbols
        $numberOfCrossovers = 1;
        $considerRating = false;

        $recombinator = new SymbolArrayCrossoverRecombinator($numberOfCrossovers,$intRandomizer, $booleanRandomizr, $considerRating );

        $genotype1 = new SymbolArrayGenotype(new IntSymbolFactory(new IntRandomizer()));
        $genotype2 = new SymbolArrayGenotype(new IntSymbolFactory(new IntRandomizer()));

        $value11 = 1;
        $value12 = 2;
        $value13 = 3;

        $value21 = 4;
        $value22 = 5;
        $value23 = 6;
        $genotype1->setSymbolAt(new SimpleSymbol($value11),0);
        $genotype1->setSymbolAt(new SimpleSymbol($value12),1);
        $genotype1->setSymbolAt(new SimpleSymbol($value13),2);

        $genotype2->setSymbolAt(new SimpleSymbol($value21),0);
        $genotype2->setSymbolAt(new SimpleSymbol($value22),1);
        $genotype2->setSymbolAt(new SimpleSymbol($value23),2);

        $newGenotype = $recombinator->recombine($genotype1, $genotype2);
        $this->assertEquals($value11, $newGenotype->getSymbolAt(0)->getValue());
        $this->assertEquals($value12, $newGenotype->getSymbolAt(1)->getValue());
        //Crossover
        $this->assertEquals($value23, $newGenotype->getSymbolAt(2)->getValue());


    }
}