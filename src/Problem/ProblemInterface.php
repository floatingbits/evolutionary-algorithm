<?php

namespace FloatingBits\EvolutionaryAlgorithm\Problem;

use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;

interface ProblemInterface
{
    /**
     * @return EvolverFactoryInterface
     */
    public function getEvolverFactory(): EvolverFactoryInterface;

    public function getSpecimenGenerator(): SpecimenGeneratorInterface;
}