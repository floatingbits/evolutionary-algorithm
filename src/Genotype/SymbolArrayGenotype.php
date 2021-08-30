<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SimpleSymbol;
use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SymbolFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\SymbolInterface;

/**
 * Class SymbolArrayGenotype
 * @package FloatingBits\EvolutionaryAlgorithm\Genotype
 * @template T
 */
class SymbolArrayGenotype implements SymbolArrayGenotypeInterface
{
    /** @var SymbolInterface<T>[] */
    private $data = [];

    /** @var SymbolFactoryInterface<T> */
    private $symbolFactory;

    public function __construct(SymbolFactoryInterface $symbolFactory)
    {
        $this->symbolFactory = $symbolFactory;
    }

    public function initialize(int $length)
    {
        $this->data = [];
        for ($i = 0; $i < $length; $i++) {
            $this->data[$i] = $this->getRandomSymbol();
        }
    }


    /**
     * @todo Implementation via strategy
     *
     * @return SymbolInterface<T>
     */
    public function getRandomSymbol()
    {
        return $this->symbolFactory->getRandomSymbol();
    }
    public function getSymbolLength()
    {
        return count($this->data);
    }

    /**
     * @param int $position
     * @return SymbolInterface<T>
     */
    public function getSymbolAt(int $position): SymbolInterface
    {
        return $this->data[$position];
    }

    /**
     * @param SymbolInterface<T> $symbol
     * @param int $position
     */
    public function setSymbolAt(SymbolInterface $symbol, int $position)
    {
        $this->data[$position] = $symbol;
    }

}