<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface TournamentInterface
{
    public function runTournament();
    /**
     * @return SpecimenCollection
     */
    public function getSpecimenCollection(): SpecimenCollection;
    /**
     * @param SpecimenCollection $specimenCollection
     */
    public function setSpecimenCollection(SpecimenCollection $specimenCollection);

    /**
     * @param EvolverInterface $evolver
     */
    public function setEvolver(EvolverInterface $evolver);
}