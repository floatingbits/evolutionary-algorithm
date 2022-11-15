<?php

namespace FloatingBits\EvolutionaryAlgorithm\Mutation;

use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\AbstractCollectionReplenisher;
use FloatingBits\EvolutionaryAlgorithm\Specimen\CollectionReplenishInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;

/**
 * @template T0 of GenotypeInterface
 * @template T1 of FitnessInterface
 */
class CollectionMutator extends AbstractCollectionReplenisher
{
    /**
     * @var MutatorInterface<T0>
     */
    private $individualMutator;
    /**
     * @var ConfigurableIntRandomizerInterface
     */
    private $intRandomizer;

    /**
     * @param MutatorInterface $individualMutator
     * @param ConfigurableIntRandomizerInterface $intRandomizer
     */
    public function __construct(MutatorInterface $individualMutator, ConfigurableIntRandomizerInterface $intRandomizer, float $weight)
    {
        parent::__construct($weight);
        $this->individualMutator = $individualMutator;
        $this->intRandomizer = $intRandomizer;
    }

    /**
     * @param SpecimenCollection $specimenCollection
     * @param int $populationSize
     * @return SpecimenCollection
     */
    public function replenish(SpecimenCollection $specimenCollection, int $populationSize): SpecimenCollection
    {
        $currentCount = $originalCount = count($specimenCollection);
        while ($currentCount < $populationSize) {
            $specimen = $this->chooseMutationOrigin($specimenCollection, $originalCount);
            $newGenotype = $this->individualMutator->mutate(
                $specimen->getGenotype()
            );
            $newSpecimen = clone $specimen;
            $newSpecimen->setGenotype($newGenotype);
            $specimenCollection->addSpecimen($newSpecimen);
            $currentCount++;
        }
        return $specimenCollection;
    }

    /**
     * @param SpecimenCollection $specimenCollection
     * @param int $chooseFromNFirstIndeces
     * @return SpecimenInterface
     */
    private function chooseMutationOrigin(SpecimenCollection $specimenCollection, int $chooseFromNFirstIndeces) {
        $this->intRandomizer->setMax($chooseFromNFirstIndeces - 1);
        $index = $this->intRandomizer->randomInt();
        return $specimenCollection->getSpecimen($index);
    }



}