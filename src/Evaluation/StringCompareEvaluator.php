<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evaluation;

use FloatingBits\EvolutionaryAlgorithm\Phenotype\FloatArrayPhenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\StringPhenotype;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\StringPhenotypeInterface;

class StringCompareEvaluator implements EvaluatorInterface
{
    /** @var string  */
    private $targetString;
    public function __construct(string $targetString) {
        $this->targetString = $targetString;
    }
    /**
     * @param StringPhenotypeInterface $phenotype
     * @return FitnessInterface
     */
    public function evaluate($phenotype): FitnessInterface
    {
        $characters1 = str_split($this->targetString);
        $characters2 = str_split($phenotype->getString());
        $longest = sizeof($characters1) > sizeof($characters2) ? $characters1 : $characters2;
        $shortest = sizeof($characters1) > sizeof($characters2) ? $characters2 : $characters1;
        $score = 0;
        foreach ($shortest as $key => $schar) {
            if ($schar === $longest[$key]) {
                $score++;
            }
        }
        return new SimpleFitness($score);
    }

}