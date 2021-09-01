<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;

/**
 * @template T0 of GenotypeInterface
 */
class Specimen implements SpecimenInterface
{
    /** @var float */
    private $evaluation;
    /** @var T0 */
    private $genotype;

    public function __construct() {

    }

    /**
     * @return T0
     */
    public function getGenotype()
    {
        return $this->genotype;
    }

    /**
     * @param T0 $genotype
     */
    public function setGenotype($genotype): void
    {
        $this->genotype = $genotype;
    }

    /**
     * @return float
     */
    public function getEvaluation(): FitnessInterface
    {
        return $this->evaluation;
    }

    /**
     * @param FitnessInterface $evaluation
     */
    public function setEvaluation(FitnessInterface $evaluation): void
    {
        $this->evaluation = $evaluation;
    }




}