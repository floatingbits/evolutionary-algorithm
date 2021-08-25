<?php


namespace FloatingBits\EvolutionaryAlgorithm\Selection;


use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface SelectorInterface
{
    public function select(SpecimenCollection $specimenCollection): SpecimenCollection;

}