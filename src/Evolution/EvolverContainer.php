<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evolution;

trait EvolverContainer
{
    protected $evolver;

    public function setEvolver(EvolverInterface $evolver) {
        $this->evolver = $evolver;
    }
}