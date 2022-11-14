<?php


namespace FloatingBits\EvolutionaryAlgorithm\Selection;


use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface SelectorInterface
{
    /**
     * @param SpecimenCollection $specimenCollection
     * @param bool $removeDuplicates
     * @return SpecimenCollection
     */
    public function select(SpecimenCollection $specimenCollection, bool $removeDuplicates = true): SpecimenCollection;

}