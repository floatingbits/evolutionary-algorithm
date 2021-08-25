<?php
namespace FloatingBits\EvolutionaryAlgorithm\Evaluation;

interface EvaluatorInterface
{
    public function evaluateSpecimen($specimen):float;
}