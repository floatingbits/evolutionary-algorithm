<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
/**
 * @todo: consider to remove this because YAGNI
 */
interface LinkInterface
{
    /**
     * @return NodeInterface[]
     */
    public function getNodes(): array;
}