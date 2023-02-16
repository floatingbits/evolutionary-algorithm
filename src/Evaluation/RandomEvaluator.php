<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evaluation;

class RandomEvaluator implements EvaluatorInterface
{
    public function evaluate($phenotype): FitnessInterface
    {
        return new SimpleFitness(mt_rand(0,100));
    }
}