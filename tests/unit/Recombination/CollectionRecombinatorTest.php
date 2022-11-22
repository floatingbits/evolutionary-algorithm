<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Recombination;

use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinator;
use FloatingBits\EvolutionaryAlgorithm\Recombination\SymbolArrayCrossoverRecombinator;
use FloatingBits\EvolutionaryAlgorithm\Specimen\Specimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use PHPUnit\Framework\TestCase;

class CollectionRecombinatorTest extends TestCase
{
    public function testRecombine() {
        $intRandomizer = $this->createMock(IntRandomizer::class);
        $intRandomizer->method('randomInt')->willReturnOnConsecutiveCalls(1,2);
        $individualRecombinator = $this->createMock(SymbolArrayCrossoverRecombinator::class);
        $recombinator = new CollectionRecombinator($individualRecombinator, $intRandomizer,1);
        $specimenCollection = $this->createMock(SpecimenCollection::class);
        $specimenCollection->method('count')->willReturn(2);
        $specimen1 = $this->createMock(Specimen::class);
        $specimen2 = $this->createMock(Specimen::class);
        $specimenCollection->method('getSpecimen')->willReturnCallback(function(int $index) use ($specimen1, $specimen2) {
            if ($index === 0) {
                return $specimen1;
            }
            return $specimen2;
        });
        $specimenCollection->expects($this->once())->method('addSpecimen');
        $individualRecombinator->expects($this->once())->method('recombine');

        $newCollection = $recombinator->recombine($specimenCollection, 3);


    }
}