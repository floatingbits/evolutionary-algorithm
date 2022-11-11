<?php

namespace FloatingBits\EvolutionaryAlgorithm\Recombination;
use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;

/**
 * @template T0 of GenotypeInterface
 * @template T1 of FitnessInterface
 */
interface IndividualRecombinatorInterface
{
    /**
     * @param T0 $genotype1
     * @param T0 $genotype2
     * @param T1|null $rating1
     * @param T1|null $rating2
     * @return T0
     */
    public function recombine($genotype1, $genotype2, $rating1 = null, $rating2 = null);
}