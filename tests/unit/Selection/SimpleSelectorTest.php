<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Selection;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\SimpleFitness;
use FloatingBits\EvolutionaryAlgorithm\Selection\SimpleSelector;
use FloatingBits\EvolutionaryAlgorithm\Specimen\Specimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use PHPUnit\Framework\TestCase;

class SimpleSelectorTest extends TestCase
{
    public function testCreateInstance() {
       $simpleSelector = new SimpleSelector(0.5);
        $this->addToAssertionCount(1);  // does not throw an exception
    }
    public function testCreateInstanceWithException() {
        $this->expectException(\InvalidArgumentException::class);
        $simpleSelector = new SimpleSelector(1.5);
    }
    
    public function testSelect() {
        $simpleSelector = new SimpleSelector(0.5);
        
        $specimenCollection = new SpecimenCollection();
        
        $survivingSpecimen1 = $this->createMock(Specimen::class);
        $survivingSpecimen1->method('getEvaluation')->willReturn(new SimpleFitness(10.0));
        $specimenCollection->addSpecimen($survivingSpecimen1);
        $survivingSpecimen2 = $this->createMock(Specimen::class);
        $survivingSpecimen2->method('getEvaluation')->willReturn(new SimpleFitness(8.0));
        $specimenCollection->addSpecimen($survivingSpecimen2);

        //Using mocks here seems to cause a bug in assertNotContainsEquals :/
        $dyingSpecimen1 = new Specimen();
        $dyingSpecimen1->setEvaluation(new SimpleFitness(5.8));
        $specimenCollection->addSpecimen($dyingSpecimen1);
        $dyingSpecimen2 = new Specimen();
        $dyingSpecimen2->setEvaluation(new SimpleFitness(1));
        $specimenCollection->addSpecimen($dyingSpecimen2);

        $specimenCollection = $simpleSelector->select($specimenCollection);

        $this->assertCount(2, $specimenCollection);

        $this->assertContainsEquals($survivingSpecimen1, $specimenCollection);
        $this->assertContainsEquals($survivingSpecimen2, $specimenCollection );
        $this->assertNotContainsEquals($dyingSpecimen1, $specimenCollection);
        $this->assertNotContainsEquals($dyingSpecimen2, $specimenCollection);
        

    }
}
