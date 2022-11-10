<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Phenotype;

use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Genotype\Genotype;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Phenotype\PhenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;

/**
 * @implements PhenotypeGeneratorInterface<GenotypeInterface, PhenotypeInterface>
 */
class PhenotypeGenerator implements PhenotypeGeneratorInterface
{
    /** @var Job[] */
    private $jobs;
    public function __construct(array $jobs) {
        $this->jobs = $jobs;
    }
    public function generatePhenotype($genotype)
    {
        return new Phenotype($genotype, $this->jobs);
    }

}