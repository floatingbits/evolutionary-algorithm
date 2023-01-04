<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Tree;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

interface TreeGraphInterface
{
    public function iterateUp(FollowLinkCallableInterface $followLinkCallback, NodeInterface $fromNode = null);
    public function countLinks(): int;
    public function getRootNode(): NodeInterface;
}