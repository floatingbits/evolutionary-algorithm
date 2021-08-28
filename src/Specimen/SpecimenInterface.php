<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


interface SpecimenInterface
{
    public function getEvaluation():float;
    public function setEvaluation(float $evaluation);
    public function evaluate();
    public function mutate();
}