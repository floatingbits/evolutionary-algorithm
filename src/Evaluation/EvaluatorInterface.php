<?php
namespace FloatingBits\EvolutionaryAlgorithm\Evaluation;

/**
 * @template T of PhenotypeInterface
 */
interface EvaluatorInterface
{
    /**
     * @param T $phenotype
     * @return mixed
     */
    public function evaluate($phenotype):float;
}