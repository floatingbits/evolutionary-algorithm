<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evaluation;

use FloatingBits\EvolutionaryAlgorithm\Phenotype\FloatArrayPhenotypeInterface;

class MaxArrayEvaluator implements EvaluatorInterface
{
    /** @var bool  */
    private $invertSign;

    public function __construct(bool $invertSign = false) {
        $this->invertSign = $invertSign;
    }
    /**
     * @param FloatArrayPhenotypeInterface $phenotype
     * @return FitnessInterface
     */
    public function evaluate($phenotype): FitnessInterface
    {
        return new SimpleFitness(max($phenotype->getArray()) * ($this->invertSign ? -1 : 1) );
    }

}