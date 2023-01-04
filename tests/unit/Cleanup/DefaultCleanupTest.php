<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Cleanup;

use FloatingBits\EvolutionaryAlgorithm\Cleanup\DefaultCleanup;
use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\IntSymbolFactory;
use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotype;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\Specimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use PHPUnit\Framework\TestCase;

class DefaultCleanupTest extends TestCase
{
    public function testCleanOneOfThree() {

        $cleanupToTest = new DefaultCleanup();

        $specimenCollection = new SpecimenCollection();

        $specimen1 = $this->createSpecimen([1,2,3,4]);
        $specimenCollection->addSpecimen($specimen1);

        $equalSpecimen = $this->createSpecimen([1,2,3,4]);
        $specimenCollection->addSpecimen($equalSpecimen);

        $anotherSpecimen = $this->createSpecimen([1,2,3,5]);
        $specimenCollection->addSpecimen($anotherSpecimen);

        $this->assertCount(3, $specimenCollection);
        $specimenCollection = $cleanupToTest->cleanup($specimenCollection);
        $this->assertCount(2, $specimenCollection);
    }

    private function createSpecimen(array $genotypeValues): Specimen {
        $symbolRandomizer = $this->createMock(IntRandomizerInterface::class);
        $symbolRandomizer->method('randomInt')->willReturnOnConsecutiveCalls(...$genotypeValues);
        $symbolFactory = new IntSymbolFactory($symbolRandomizer);
        $genotype = new SymbolArrayGenotype($symbolFactory);
        $genotype->initialize(sizeof($genotypeValues));
        $specimen = new Specimen();
        $specimen->setGenotype($genotype);
        return $specimen;
    }
}