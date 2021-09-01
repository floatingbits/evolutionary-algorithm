<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;

/**
 *
 */
interface SpecimenInterface
{
    public function getGenotype();
    public function setGenotype($genotype);
    public function getEvaluation():FitnessInterface;
    public function setEvaluation(FitnessInterface $evaluation);
}