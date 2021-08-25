<?php


namespace FloatingBits\EvolutionaryAlgorithm\Mutation;


use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface MutatorInterface
{
    public function mutate(SpecimenCollection $specimenCollection): SpecimenCollection;
}