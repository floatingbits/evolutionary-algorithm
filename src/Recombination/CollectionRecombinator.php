<?php

namespace FloatingBits\EvolutionaryAlgorithm\Recombination;

use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface;

/**
 * @template T0 of GenotypeInterface
 * @template T1 of FitnessInterface
 */
class CollectionRecombinator implements CollectionRecombinatorInterface
{
    /**
     * @var IndividualRecombinatorInterface<T0,T1>
     */
    private $individualRecombinator;
    /**
     * @var ConfigurableIntRandomizerInterface
     */
    private $intRandomizer;

    /**
     * @param $individualRecombinator
     * @param ConfigurableIntRandomizerInterface $intRandomizer
     */
    public function __construct($individualRecombinator, ConfigurableIntRandomizerInterface $intRandomizer)
    {
        $this->individualRecombinator = $individualRecombinator;
        $this->intRandomizer = $intRandomizer;
    }

    /**
     * @param SpecimenCollection $specimenCollection
     * @param int $populationSize
     * @return SpecimenCollection
     */
    public function recombine(SpecimenCollection $specimenCollection, int $populationSize): SpecimenCollection
    {
        $currentCount = $originalCount = count($specimenCollection);
        while ($currentCount < $populationSize) {
            /** @var SpecimenInterface $specimen1, $specimen2 */
            list($specimen1, $specimen2) = $this->chooseRecombinationCouple($specimenCollection, $originalCount);
            $newGenotype = $this->individualRecombinator->recombine(
                $specimen1->getGenotype(), $specimen2->getGenotype(),
                $specimen1->getEvaluation(), $specimen2->getEvaluation()
            );
            $newSpecimen = clone $specimen1;
            $newSpecimen->setGenotype($newGenotype);
            $specimenCollection->addSpecimen($newSpecimen);
            $currentCount++;
        }
        return $specimenCollection;
    }

    /**
     * @param SpecimenCollection $specimenCollection
     * @param int $chooseFromNFirstIndeces
     * @return SpecimenInterface[]
     */
    private function chooseRecombinationCouple(SpecimenCollection $specimenCollection, int $chooseFromNFirstIndeces) {
        $this->intRandomizer->setMax($chooseFromNFirstIndeces - 1);
        $index1 = $this->intRandomizer->randomInt();
        $index2 = $this->intRandomizer->randomInt();
        while ($index1 === $index2 && $chooseFromNFirstIndeces > 1) {
            //Only go here if collection has at least two specimen.
            $index2 = $this->intRandomizer->randomInt();
        }
        return [$specimenCollection->getSpecimen($index1), $specimenCollection->getSpecimen($index2)];
    }



}