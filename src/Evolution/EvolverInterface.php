<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface EvolverInterface
{
    public function evolve(SpecimenCollection $oldGeneration);
    public function cleanup(SpecimenCollection $oldGeneration);
}