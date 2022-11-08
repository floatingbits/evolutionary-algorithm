<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evolution;

interface EvolverFactoryInterface
{
    public function createEvolver(): EvolverInterface;
}