<?php

namespace FloatingBits\EvolutionaryAlgorithm\Phenotype;

interface FloatArrayPhenotypeInterface extends PhenotypeInterface
{
    /**
     * @return float[]
     */
    public function getArray();
}