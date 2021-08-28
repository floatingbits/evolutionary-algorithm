<?php


namespace FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol;


class SimpleSymbol implements SymbolInterface
{
    private $value;
    public function __construct($value) {
        $this->value = $value;
    }
    public function getValue()
    {
        return $this->value;
    }
}