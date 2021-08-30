<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SymbolInterface;

/**
 * Interface SymbolArrayGenotypeInterface
 * @package FloatingBits\EvolutionaryAlgorithm\Genotype
 * @template T
 * @template S
 */
interface SymbolArrayGenotypeInterface extends GenotypeInterface
{
    public function getSymbolAt(int $position): SymbolInterface;
    public function setSymbolAt(SymbolInterface $symbol, int $position);
    public function getSymbolLength();
    public function getRandomSymbol();
    public function initialize(int $length);
}