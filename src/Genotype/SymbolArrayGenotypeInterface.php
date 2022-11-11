<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SymbolInterface;

/**
 * Interface SymbolArrayGenotypeInterface
 * @package FloatingBits\EvolutionaryAlgorithm\Genotype
 * @template S
 */
interface SymbolArrayGenotypeInterface extends GenotypeInterface
{
    /**
     * @param int $position
     * @return SymbolInterface<S>
     */
    public function getSymbolAt(int $position): SymbolInterface;

    /**
     * @param SymbolInterface<S> $symbol
     * @param int $position
     * @return void
     */
    public function setSymbolAt(SymbolInterface $symbol, int $position);
    public function getSymbolLength();
    public function getRandomSymbol();
    public function initialize(int $length);
}