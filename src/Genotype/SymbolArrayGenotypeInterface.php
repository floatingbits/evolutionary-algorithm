<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SymbolInterface;

/**
 * Interface SymbolArrayGenotypeInterface
 * @package FloatingBits\EvolutionaryAlgorithm\Genotype
 * @template T
 * @template S
 * @template-extends GenotypeInterface<T>
 */
interface SymbolArrayGenotypeInterface extends GenotypeInterface
{
    /**
     * @param int $position
     * @return SymbolInterface<S>
     */
    public function getSymbolAt(int $position): SymbolInterface;
    public function setSymbolAt(SymbolInterface $symbol, int $position);
    public function getSymbolLength();
    public function getRandomSymbol();
    public function initialize(int $length);
}