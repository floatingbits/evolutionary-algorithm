<?php


namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;


class BooleanRandomizer implements BooleanRandomizerInterface, BiasedRandomizerInterface
{
    /** @var float $probability */
    private $probability;

    /**
     * @param float $probability
     */
    public function __construct(float $probability = 0.5) {
        if ($probability < 0 || $probability > 1) {
            throw new \InvalidArgumentException("The probability must be between 0 and 1 inclusively. $probability given");
        }
        $this->probability = $probability;
    }

    /**
     * @param float $bias
     */
    public function setBias(float $bias): void
    {
        $this->probability = $bias;
    }

    /**
     * @return bool
     */
    public function randomYesOrNo()
    {
        return $this->probability > mt_rand() / mt_getrandmax();
    }

}