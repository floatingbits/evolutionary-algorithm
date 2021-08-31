<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

interface ConfigurableIntRandomizerInterface extends IntRandomizerInterface
{
    public function setMax(int $max);
    public function setMin(int $min);
}