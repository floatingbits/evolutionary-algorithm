<?php

namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

/**
 * @template T
 */
interface TreeGraphGenotypeInterface extends GenotypeInterface
{
    /**
     * @return TreeGraphInterface<T>
     */
    public function getTreeGraph(): TreeGraphInterface;
}