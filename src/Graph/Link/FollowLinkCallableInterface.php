<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

interface FollowLinkCallableInterface
{
    /**
     * @param DirectedLinkInterface $directedLink
     * @return bool (return true if you want to stop propagation)
     */
    public function __invoke(DirectedLinkInterface $directedLink): bool;
    public function startNode(NodeInterface $node);
    public function endNode(NodeInterface $node);
}