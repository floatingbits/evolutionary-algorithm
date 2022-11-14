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
     * @param bool $removeDuplicates
     * @return SpecimenCollection
     */
    public function select(SpecimenCollection $specimenCollection, bool $removeDuplicates = true): SpecimenCollection
    {
        $numberOfSurvivors = round($this->survivalRate * count($specimenCollection));
        return $this->selectByNumber($specimenCollection, $numberOfSurvivors, $removeDuplicates);
    }

    /**
     * @param SpecimenCollection $specimenCollection
     * @param int $numberOfSurvivors
     * @param bool $removeDuplicates
     * @return SpecimenCollection
     */
    private function selectByNumber(SpecimenCollection $specimenCollection, int $numberOfSurvivors, bool $removeDuplicates): SpecimenCollection {
        $specimenCollection->sortByFitness();

        $newCollection = new SpecimenCollection();
        /** @var SpecimenInterface $lastSpecimen */
        $lastSpecimen = null;
        $numberOfFilteredSpecimen = 0;
        /** @var SpecimenInterface $specimen */
        foreach ($specimenCollection as $specimen) {
            if ($numberOfSurvivors > 0 &&
                (!$removeDuplicates ||
                !$lastSpecimen ||
                $lastSpecimen->getEvaluation()->getMainFitness() !== $specimen->getEvaluation()->getMainFitness() ||
                !$lastSpecimen->getGenotype()->equals($specimen->getGenotype()))

            )   {
                    $numberOfSurvivors--;
                    $lastSpecimen = clone $specimen;
                    $newCollection->addSpecimen($lastSpecimen);

            }
            else {
                if ($numberOfSurvivors > 0) {
                    $numberOfFilteredSpecimen++;
                }
            }

        }
        return $newCollection;
    }

}