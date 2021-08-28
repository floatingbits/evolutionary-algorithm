<?php


namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;


class BooleanRandomizer implements BooleanRandomizerInterface
{
    /** @var float */
    private $probability;

    public function __construct($probability) {
        if ($probability < 0 || $probability > 1) {
            throw new \InvalidArgumentException("The probability must be between 0 and 1 inclusively. $probability given");
        }
        $this->probability = $probability;
    }

    public function randomYesOrNo()
    {
        return $this->probability > mt_rand() / mt_getrandmax();
    }

}