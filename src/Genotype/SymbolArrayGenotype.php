<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SimpleSymbol;
use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SymbolInterface;

/**
 * Class SymbolArrayGenotype
 * @package FloatingBits\EvolutionaryAlgorithm\Genotype
 */
class SymbolArrayGenotype implements SymbolArrayGenotypeInterface
{
    /** @var SymbolInterface[] */
    private $data = [];


    /**
     * @todo Implementation via strategy
     *
     * @return SymbolInterface
     */
    public function getRandomSymbol()
    {
        return new SimpleSymbol(mt_rand(0,10));
    }
    public function getSymbolLength()
    {
        return count($this->data);
    }

    public function getSymbolAt(int $position): SymbolInterface
    {
        return $this->data[$position];
    }

    public function setSymbolAt(SymbolInterface $symbol, int $position)
    {
        $this->data[$position] = $symbol;
    }

}