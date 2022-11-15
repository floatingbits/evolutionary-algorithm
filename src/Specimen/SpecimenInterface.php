<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;

/**
 *
 */
interface SpecimenInterface
{
    /** @return GenotypeInterface */
    public function getGenotype(): GenotypeInterface;
    public function setGenotype(GenotypeInterface $genotype);
    public function getEvaluation():FitnessInterface;
    public function setEvaluation(FitnessInterface $evaluation);
}