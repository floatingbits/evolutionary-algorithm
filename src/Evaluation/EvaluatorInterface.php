<?php
namespace FloatingBits\EvolutionaryAlgorithm\Evaluation;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;
/**
 * @template T of PhenotypeInterface
 */
interface EvaluatorInterface
{
    /**
     * @param T $phenotype
     * @return FitnessInterface
     */
    public function evaluate($phenotype): FitnessInterface;
}