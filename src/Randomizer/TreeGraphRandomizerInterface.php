<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

/**
 * @template T
 */
interface TreeGraphRandomizerInterface
{
    /**
     * @return TreeGraphInterface<T>
     */
    public function randomTreeGraph();
}