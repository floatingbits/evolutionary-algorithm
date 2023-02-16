<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

interface TreeGraphLinkRandomizerInterface
{
    public function fetchRandomLink(TreeGraphInterface $treeGraph): ?DirectedLinkInterface;
}