<?php


namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;


class IntRandomizer implements IntRandomizerInterface
{
    /** @var int */
    private $min;
    /** @var int */
    private $max;

    public function __construct(int $max, int $min) {
        $this->max = $max;
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function randomInt():int
    {
        return mt_rand($this->min, $this->max);
    }

}