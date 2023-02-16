<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;

/**
 *
 */
interface SpecimenInterface
{
    /** @return GenotypeInterface */
    public function getGenotype(): GenotypeInterface;
    public function setGenotype(GenotypeInterface $genotype);
    /** @return PhenotypeInterface */
    public function getPhenotype(): ?PhenotypeInterface;
    public function setPhenotype(PhenotypeInterface $phenotype);
    public function getEvaluation():FitnessInterface;
    public function setEvaluation(FitnessInterface $evaluation);
}