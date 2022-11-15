<?php

namespace FloatingBits\EvolutionaryAlgorithm\Specimen;

interface CollectionReplenishInterface
{
    public function replenish(SpecimenCollection $specimenCollection, int $populationSize): SpecimenCollection;
    public function getWeight(): float;
}