<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol;

/**
 * @template T
 */
interface SymbolInterface
{
    /** @return T */
    public function getValue();
}