<?php

namespace FloatingBits\EvolutionaryAlgorithm\Specimen;

abstract class AbstractCollectionReplenisher implements CollectionReplenishInterface
{
    protected $weight;
    public function __construct(float $weight) {
        $this->weight = $weight;
    }
    public function getWeight(): float
    {
        return $this->weight;
    }
}