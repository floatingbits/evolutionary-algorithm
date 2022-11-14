<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

class LinearBias implements BiasInterface
{
    public function getBiasedValue($value, $bias, $max, $min)
    {
        $range = $max - $min;
        if ($range === 0) {
            return $value;
        }
        $lowerLimit = max ($min, $max - $range * $bias);
        if ($value <= $lowerLimit) {
            return $min;
        }
        $upperLimit = min($max, $min + $range / $bias);
        if ($value >= $upperLimit) {
            return $max;
        }
        return $range*($value - $lowerLimit)/($upperLimit - $lowerLimit);
    }


}