<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

trait BiasedTrait
{
    private float $bias;
    /** @var BiasInterface */
    private BiasInterface $biasStrategy;

    /**
     * @param float $bias
     */
    public function setBias(float $bias): void
    {
        $this->bias = $bias;
    }
}