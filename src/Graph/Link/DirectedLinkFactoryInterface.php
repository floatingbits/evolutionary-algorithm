<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
/**
 * @template T of NodeInterface
 */
interface DirectedLinkFactoryInterface
{
    /**
     * @return DirectedLinkInterface<T>
     */
    public function createDirectedLink();
}