<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem;

use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\AssignJobToMachinesEvolverFactory;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Specimen\SpecimenGenerator;
use FloatingBits\EvolutionaryAlgorithm\Problem\ProblemInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;

abstract class AbstractProblem implements ProblemInstanceInterface, ProblemInterface
{
    public function getEvolverFactory(): EvolverFactoryInterface
    {
        return new AssignJobToMachinesEvolverFactory($this->getJobs());
    }

    public function getSpecimenGenerator(): SpecimenGeneratorInterface
    {
        return new SpecimenGenerator(count($this->getJobs()), $this->getNumberOfMachines());
    }

}