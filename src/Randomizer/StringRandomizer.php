<?php


namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;


class StringRandomizer implements StringRandomizerInterface
{
    /** @var string[] */
    private $characterSet;
    /** @var int */
    private $length;


    public function __construct(int $length = 1, array $characterSet = null) {
        $this->length = $length;
        $this->characterSet = $characterSet ?? $this->defaultCharacterSet();

    }

    private function defaultCharacterSet() {
        return array_merge(range('A', 'Z'), range('a', 'z'), [' ']);
    }

    /**
     * @return string
     */
    public function randomString():string
    {
        $randString = '';
        while(strlen($randString) < $this->length) {
            $randString .= $this->characterSet[array_rand($this->characterSet)];
        }
        return $randString;
    }

}