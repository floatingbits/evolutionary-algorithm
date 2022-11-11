<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Phenotype;

use FloatingBits\EvolutionaryAlgorithm\Phenotype\FloatArrayPhenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;

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

    /**
     * @param $genotype
     * @return FloatArrayPhenotypeInterface
     */
    public function generatePhenotype($genotype)
    {
        return new Phenotype($genotype, $this->jobs);
    }

}