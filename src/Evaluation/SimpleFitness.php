<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evaluation;

class SimpleFitness implements FitnessInterface
{
    /** @var float */
    private $mainFitness;

    /**
     * @param float $mainFitness
     */
    public function __construct(float $mainFitness)
    {
        $this->mainFitness = $mainFitness;
    }

    /**
     * @return float
     */
    public function getMainFitness(): float
    {
        return $this->mainFitness;
    }

    /**
     * @param float $mainFitness
     */
    public function setMainFitness(float $mainFitness): void
    {
        $this->mainFitness = $mainFitness;
    }




}