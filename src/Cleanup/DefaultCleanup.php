<?php

namespace FloatingBits\EvolutionaryAlgorithm\Cleanup;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

class DefaultCleanup implements CleanupInterface
{
    public function cleanup(SpecimenCollection $specimens): SpecimenCollection
    {
        $returnCollection = new SpecimenCollection();
        foreach ($specimens as $key => $originalSpecimen) {
            $addSpecimen = true;
            while ($key++ < $specimens->count() - 1) {
                if ($originalSpecimen->getGenotype()->equals($specimens->getSpecimen($key)->getGenotype())) {
                    $addSpecimen = false;
                }
            }
            if ($addSpecimen) {
                $returnCollection->addSpecimen($originalSpecimen);
            }
        }
        return $returnCollection;
    }


}