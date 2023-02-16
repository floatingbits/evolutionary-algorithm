<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

class FloatRandomizer implements FloatRandomizerInterface
{
    /** @var float */
    private $min;
    /** @var float */
    private $max;
    use BiasedTrait;

    public function __construct(float $max = 1, float $min = 0,  BiasInterface $biasStrategy = null, float $bias = 1) {

        $this->max = $max;
        $this->min = $min;
        $this->bias = $bias;
        if ($biasStrategy) {
            $this->biasStrategy = $biasStrategy;
        }
        else {
            $this->biasStrategy = new LinearBias();
        }

    }

    public function randomFloat(): float
    {
        $randomFloat =  $this->auxRandom($this->min, $this->max);
        if ($this->bias != 1)  {
            $randomFloat = $this->biasStrategy->getBiasedValue($randomFloat, $this->bias, $this->max, $this->min);
        }
        return $randomFloat;
    }

    function auxRandom($min,$max): float {
        return ($min+lcg_value()*(abs($max-$min)));
    }

    /**
     * @param float $min
     */
    public function setMin(float $min): void
    {
        $this->min = $min;
    }

    /**
     * @param float $max
     */
    public function setMax(float $max): void
    {
        $this->max = $max;
    }


}