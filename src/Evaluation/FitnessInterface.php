<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evaluation;

interface FitnessInterface
{
    public function getMainFitness(): float;
}