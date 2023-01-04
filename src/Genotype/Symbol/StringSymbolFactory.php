<?php

namespace FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol;

use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\StringRandomizerInterface;

/**
 * @template-implements SymbolFactoryInterface<string>
 */
class StringSymbolFactory implements SymbolFactoryInterface
{
    /** @var IntRandomizerInterface */
    private $randomizer;

    public function __construct(StringRandomizerInterface $randomizer) {
        $this->randomizer = $randomizer;
    }

    /**
     * @return SimpleSymbol<int>
     */
    public function getRandomSymbol(): SimpleSymbol
    {
        return new SimpleSymbol($this->randomizer->randomString());
    }


}