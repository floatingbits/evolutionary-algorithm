<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;

class Tournament
{
    /** @var EvolverInterface */
    private $evolver;

    /** @var SpecimenCollection */
    private $specimenCollection;

    /** @var SpecimenGeneratorInterface */
    private $specimenGenerator;

    /**
     * @param EvolverInterface $evolver
     * @param SpecimenGeneratorInterface $specimenGenerator
     */
    public function __construct(EvolverInterface $evolver, SpecimenGeneratorInterface $specimenGenerator) {
        $this->evolver = $evolver;
        $this->specimenGenerator = $specimenGenerator;
    }

    public function setup(int $populationSize) {
        $this->specimenCollection = $this->specimenGenerator->generateSpecimen($populationSize);
    }

    public function runTournament($numRounds) {
        for ($i= 0; $i<$numRounds; $i++) {
            $this->specimenCollection = $this->evolver->evolve($this->specimenCollection);
        }
    }

    /**
     * @return SpecimenCollection
     */
    public function getSpecimenCollection(): SpecimenCollection {
        return $this->specimenCollection;
    }


}