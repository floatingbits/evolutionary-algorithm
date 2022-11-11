<?php

namespace FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol;

use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizerInterface;

/**
 * @implements SymbolFactoryInterface<int>
 */
class IntSymbolFactory implements SymbolFactoryInterface
{
    /** @var IntRandomizerInterface */
    private $randomizer;

    public function __construct(IntRandomizerInterface $randomizer) {
        $this->randomizer = $randomizer;
    }

    /**
     * @return SimpleSymbol<int>
     */
    public function getRandomSymbol(): SimpleSymbol
    {
        return new SimpleSymbol($this->randomizer->randomInt());
    }


}