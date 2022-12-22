<?php

namespace FloatingBits\EvolutionaryAlgorithm\Phenotype;


use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotypeInterface;

class StringPhenotype implements StringPhenotypeInterface
{
    /** @var SymbolArrayGenotypeInterface  */
    private $genotype;
    public function __construct(SymbolArrayGenotypeInterface $genotype) {
        $this->genotype = $genotype;
    }

    public function getString(): string
    {
        $resultString = '';
        for ($i = 0;  $i < $this->genotype->getSymbolLength(); $i++) {
            $resultString .= $this->genotype->getSymbolAt($i)->getValue();
        }
        return $resultString;
    }

}