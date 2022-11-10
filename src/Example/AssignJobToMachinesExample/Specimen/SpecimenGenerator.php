<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Specimen;

use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Genotype\Genotype;
use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\IntSymbolFactory;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Specimen\Specimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;

class SpecimenGenerator implements SpecimenGeneratorInterface
{
    /** @var int */
    private $numJobs;
    /** @var int */
    private $numMachines;
    public function __construct(int $numJobs, int $numMachines)
    {
        $this->numJobs = $numJobs;
        $this->numMachines = $numMachines;
    }

    /**
     * @param int $populationSize
     * @return \FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection
     */
    public function generateSpecimen(int $populationSize)
    {
        $collection = new SpecimenCollection();
        while($populationSize--) {
            $specimen = new Specimen();
            $symbolFactory = new IntSymbolFactory(new IntRandomizer($this->numMachines - 1,0));
            $genotype = new Genotype($symbolFactory);
            $genotype->initialize($this->numJobs);
            $specimen->setGenotype($genotype);
            $collection->addSpecimen($specimen);
        }
        return $collection;
    }

}