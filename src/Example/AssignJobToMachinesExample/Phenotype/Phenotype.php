<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Phenotype;

use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Genotype\Genotype;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\FloatArrayPhenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;

class Phenotype implements FloatArrayPhenotypeInterface
{
    /** @var Genotype  */
    private $genotype;
    /** @var Job[] $jobs */
    private $jobs;
    public function __construct(Genotype $genotype, array $jobs)
    {
        $this->genotype = $genotype;
        $this->jobs = $jobs;
    }

    public function getArray()
    {
        $times = [];
        for ($i = 0; $i < $this->genotype->getSymbolLength(); $i++ ) {
            $assignedToMachineNo = $this->genotype->getSymbolAt($i)->getValue();
            if (!isset($times[$assignedToMachineNo])) {
                $times[$assignedToMachineNo] = 0;
            }
            $times[$assignedToMachineNo] += $this->jobs[$i]->getTimeForMachineNo($assignedToMachineNo);
        }

        return $times;
    }
}