<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

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
    public function equals(GenotypeInterface $otherGenotype): bool
    {
        if ($otherGenotype instanceof static) {
            if ($this->getSymbolLength() === $otherGenotype->getSymbolLength()) {
                for ($i = 0; $i < $this->getSymbolLength(); $i++) {
                    if ($this->getSymbolAt($i)->getValue() != $otherGenotype->getSymbolAt($i)->getValue()) {
                        return false;
                    }
                }
                return true;
            }
        }
        return false;
    }

    /**
     * @todo Implementation via strategy
     *
     * @return SymbolInterface<T>
     */
    public function getRandomSymbol(): SymbolInterface
    {
        return $this->symbolFactory->getRandomSymbol();
    }

    /**
     * @return int
     */
    public function getSymbolLength(): int
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