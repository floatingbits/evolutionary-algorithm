<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Node;

/**
 * @template T
 */
interface NodeFactoryInterface
{
    /**
     * @return NodeInterface<T>
     */
    public function createNode();
}