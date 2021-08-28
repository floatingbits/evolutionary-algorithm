<?php


namespace FloatingBits\EvolutionaryAlgorithm\Phenotype;

/**
 * @template T0 of GenotypeInterface
 * @template T1 of PhenotypeInterface
 */
interface PhenotypeGeneratorInterface
{
    /**
     * @param  T0
     * @return T1
     */
    public function generatePhenotype($genotype);
}