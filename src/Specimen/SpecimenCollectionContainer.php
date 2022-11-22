<?php

namespace FloatingBits\EvolutionaryAlgorithm\Specimen;

trait SpecimenCollectionContainer
{
    /** @var SpecimenCollection $specimenCollection */
    protected $specimenCollection;

    /**
     * @return SpecimenCollection
     */
    public function getSpecimenCollection(): SpecimenCollection {
        return $this->specimenCollection;
    }
    /**
     * @param SpecimenCollection $specimenCollection
     */
    public function setSpecimenCollection(SpecimenCollection $specimenCollection) {
        $this->specimenCollection = $specimenCollection;
    }
}