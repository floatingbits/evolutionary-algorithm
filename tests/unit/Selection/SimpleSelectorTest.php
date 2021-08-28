<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\Selection;

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
        $survivingSpecimen1->method('getEvaluation')->willReturn(10.0);
        $specimenCollection->addSpecimen($survivingSpecimen1);
        $survivingSpecimen2 = $this->createMock(Specimen::class);
        $survivingSpecimen2->method('getEvaluation')->willReturn(8.0);
        $specimenCollection->addSpecimen($survivingSpecimen2);

        $dyingSpecimen1 = $this->createMock(Specimen::class);
        $dyingSpecimen1->method('getEvaluation')->willReturn(5.8);
        $specimenCollection->addSpecimen($dyingSpecimen1);
        $dyingSpecimen2 = $this->createMock(Specimen::class);
        $dyingSpecimen2->method('getEvaluation')->willReturn(1.0);
        $specimenCollection->addSpecimen($dyingSpecimen2);

        $specimenCollection = $simpleSelector->select($specimenCollection);

        $this->assertCount(2, $specimenCollection);

        $this->assertContains($survivingSpecimen1, $specimenCollection);
        $this->assertContains($survivingSpecimen2, $specimenCollection );
        $this->assertNotContains($dyingSpecimen1, $specimenCollection);
        $this->assertNotContains($dyingSpecimen2, $specimenCollection);
        

    }
}
