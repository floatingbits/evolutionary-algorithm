<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;

interface SpecimenInterface
{
    public function getEvaluation():FitnessInterface;
    public function setEvaluation(FitnessInterface $evaluation);
    public function evaluate();
    public function mutate();
}