<?php


namespace FloatingBits\EvolutionaryAlgorithm\Recombination;


use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface RecombinatorInterface
{
    public function recombine(SpecimenCollection $specimenCollection, int $populationSize): SpecimenCollection;
}