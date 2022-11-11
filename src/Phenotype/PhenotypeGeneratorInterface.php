<?php


namespace FloatingBits\EvolutionaryAlgorithm\Phenotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;

/**
 * @template T0 of GenotypeInterface
 * @template T1 of PhenotypeInterface
 */
interface PhenotypeGeneratorInterface
{
    /**
     * @param T0 $genotype
     * @return T1
     */
    public function generatePhenotype($genotype);
}