<?php


namespace FloatingBits\EvolutionaryAlgorithm\Recombination;


use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface CollectionRecombinatorInterface
{
    public function recombine(SpecimenCollection $specimenCollection, int $populationSize): SpecimenCollection;
}