<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\SimpleFitness;


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
        $this->evaluation = new SimpleFitness(0);
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
     * @return SimpleFitness
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