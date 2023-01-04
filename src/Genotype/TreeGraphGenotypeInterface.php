<?php

namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

interface TreeGraphGenotypeInterface extends GenotypeInterface
{
    public function getTreeGraph(): TreeGraphInterface;
}