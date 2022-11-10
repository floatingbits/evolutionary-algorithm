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

    /**
     * @param SpecimenCollection $specimenCollection
     * @return SpecimenCollection
     */
    public function select(SpecimenCollection $specimenCollection): SpecimenCollection
    {
        return $this->internalSelect($specimenCollection, $this->survivalRate);
    }

    /**
     * @param SpecimenCollection $specimenCollection
     * @param float $survivalRate
     * @return SpecimenCollection
     */
    private function internalSelect(SpecimenCollection $specimenCollection, float $survivalRate): SpecimenCollection {
        $specimenCollection->sortByFitness();

        $numberOfSurvivors = round($survivalRate * count($specimenCollection));
        $newCollection = new SpecimenCollection();
        /** @var SpecimenInterface $specimen */
        foreach ($specimenCollection as $key => $specimen) {
            $numberOfSurvivors--;
            if ($numberOfSurvivors >= 0) {
                $newCollection->addSpecimen(clone $specimen);
            }
        }
        return $newCollection;
    }

}