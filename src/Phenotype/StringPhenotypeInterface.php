<?php

namespace FloatingBits\EvolutionaryAlgorithm\Phenotype;

interface StringPhenotypeInterface extends PhenotypeInterface
{
    /**
     * @return string
     */
    public function getString(): string;
}