<?php


namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;


class IntRandomizer implements ConfigurableIntRandomizerInterface, BiasedRandomizerInterface
{
    /** @var int */
    private $min;
    /** @var int */
    private $max;
    /** @var float */
    private $bias;

    /** @var BiasInterface */
    private $biasStrategy;

    public function __construct(int $max = 0, int $min = 0,  BiasInterface $biasStrategy = null, float $bias = 1) {
        if ($max === 0 && $min === 0) {
            $max = mt_getrandmax();
        }
        $this->max = $max;
        $this->min = $min;
        $this->bias = 1;
        if ($biasStrategy) {
            $this->biasStrategy = $biasStrategy;
        }
        else {
            $this->biasStrategy = new LinearBias();
        }

    }

    /**
     * @param float $bias
     */
    public function setBias(float $bias): void
    {
        $this->bias = $bias;
    }

    /**
     * @param int $min
     */
    public function setMin(int $min): void
    {
        $this->min = $min;
    }

    /**
     * @param int $max
     */
    public function setMax($max): void
    {
        $this->max = $max;
    }



    /**
     * @return int
     */
    public function randomInt():int
    {
        $randomInt =  mt_rand($this->min, $this->max);
        if ($this->bias != 1)  {
            $randomInt = round($this->biasStrategy->getBiasedValue($randomInt, $this->bias, $this->max, $this->min));
        }
        return $randomInt;
    }

}