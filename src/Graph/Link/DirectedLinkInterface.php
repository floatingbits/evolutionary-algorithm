<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

/**
 * @template T of NodeInterface
 */
interface DirectedLinkInterface
{
    /**
     * @return T
     */
    public function getStartNode(): NodeInterface;

    /**
     * @return T
     */
    public function getEndNode(): NodeInterface;

    /**
     * @param T $startNode
     */
    public function setStartNode($startNode);

    /**
     * @param T $endNode
     * No further/native php typehinting to not override Template
     */
    public function setEndNode($endNode);

}