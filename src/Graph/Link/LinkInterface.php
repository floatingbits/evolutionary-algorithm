<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

interface LinkInterface
{
    /**
     * @return NodeInterface[]
     */
    public function getNodes(): array;
}