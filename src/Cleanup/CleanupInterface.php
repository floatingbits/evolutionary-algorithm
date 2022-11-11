<?php

namespace FloatingBits\EvolutionaryAlgorithm\Cleanup;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface CleanupInterface
{
    /**
     * @param SpecimenCollection $specimens
     * @return SpecimenCollection
     */
    public function cleanup(SpecimenCollection $specimens): SpecimenCollection;
}