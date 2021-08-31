<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

interface BiasInterface
{
    public function getBiasedValue($value, $bias, $max, $min);
}