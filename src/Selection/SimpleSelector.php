<?php


namespace FloatingBits\EvolutionaryAlgorithm\Selection;


use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface;

class SimpleSelector implements SelectorInterface
{
    /** @var float */
    private $survivalRate;

    public function __construct($survivalRate) {
        if ($survivalRate <= 0 || $survivalRate >= 1) {
            throw new \InvalidArgumentException("The survival rate must be between 0 and 1 exclusively. $survivalRate given");
        }
        $this->survivalRate = $survivalRate;
    }

    public function select(SpecimenCollection $specimenCollection): SpecimenCollection
    {
        $specimenCollection->sortByFitness();

        $numberOfSurvivors = round($this->survivalRate * count($specimenCollection));
        $newCollection = new SpecimenCollection();
        /** @var SpecimenInterface $specimen */
        foreach ($specimenCollection as $key => $specimen) {
            $numberOfSurvivors--;
            if ($numberOfSurvivors >= 0) {
                $newCollection->addSpecimen($specimen);
            }
        }
        return $newCollection;
    }

}