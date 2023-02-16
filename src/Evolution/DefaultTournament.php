<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollectionContainer;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;

class DefaultTournament implements TournamentInterface
{
    use SpecimenCollectionContainer;
    use EvolverContainer;

    /** @var int */
    private $numRounds;
    /** @var int  */
    private $cleanupAfterNRounds;



    public function runTournament() {
        for ($i = 0; $i<$this->numRounds; $i++) {
            $this->specimenCollection = $this->evolver->evolve($this->specimenCollection);
            if ($this->cleanupAfterNRounds && $i > 0 && ($i % $this->cleanupAfterNRounds === 0)) {
                $this->specimenCollection = $this->evolver->cleanup($this->specimenCollection);
            }
        }
    }

    /**
     * @return int
     */
    public function getNumRounds(): int
    {
        return $this->numRounds;
    }

    /**
     * @param int $numRounds
     */
    public function setNumRounds(int $numRounds): void
    {
        $this->numRounds = $numRounds;
    }

    /**
     * @return int
     */
    public function getCleanupAfterNRounds(): int
    {
        return $this->cleanupAfterNRounds;
    }

    /**
     * @param int $cleanupAfterNRounds
     */
    public function setCleanupAfterNRounds(int $cleanupAfterNRounds): void
    {
        $this->cleanupAfterNRounds = $cleanupAfterNRounds;
    }




}