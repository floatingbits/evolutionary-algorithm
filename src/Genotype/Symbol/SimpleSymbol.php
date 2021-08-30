<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol;

/**
 * @template T
 * @template-implements SymbolInterface<T>
 */
class SimpleSymbol implements SymbolInterface
{
    /** @var T */
    private $value;

    /**
     * @param T $value
     */
    public function __construct($value) {
        $this->value = $value;
    }
    /** @return T */
    public function getValue()
    {
        return $this->value;
    }
}