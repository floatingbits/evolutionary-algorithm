<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Tree;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

/**
 * @template T
 */
interface TreeGraphInterface
{
    /**
     * @param FollowLinkCallableInterface $followLinkCallback
     * @param NodeInterface<T>|null $fromNode
     * @return mixed
     */
    public function iterateUp(FollowLinkCallableInterface $followLinkCallback, NodeInterface $fromNode = null):bool;
    public function countLinks(): int;

    /**
     * @return NodeInterface<T>
     */
    public function getRootNode(): NodeInterface;

    /**
     * @param NodeInterface<T> $node
     * @return mixed
     */
    public function setRootNode(NodeInterface $node);
}