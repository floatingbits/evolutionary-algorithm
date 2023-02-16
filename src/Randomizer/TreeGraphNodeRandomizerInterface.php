<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

interface TreeGraphNodeRandomizerInterface
{
    public function fetchRandomNode(TreeGraphInterface $treeGraph): NodeInterface;
}