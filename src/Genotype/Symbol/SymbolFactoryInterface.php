<?php

namespace FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol;
/**
 * @template T
 */
interface SymbolFactoryInterface
{
    /**
     * @return SymbolInterface<T>
     */
    public function getRandomSymbol();
}