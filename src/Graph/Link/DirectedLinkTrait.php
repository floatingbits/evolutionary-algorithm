<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

/**
 * @template T
 */
trait DirectedLinkTrait
{
    private NodeInterface $startNode;
    private NodeInterface $endNode;
    /**
     * @return NodeInterface<T>
     */
    public function getStartNode(): NodeInterface {
        return $this->startNode;
    }

    /**
     * @param NodeInterface<T> $node
     * @return void
     */
    public function setStartNode( $node) {
        $this->startNode = $node;
    }

    /**
     * @return NodeInterface<T>
     */
    public function getEndNode(): NodeInterface {
        return $this->endNode;
    }

    /**
     * @param NodeInterface<T> $node
     * @return mixed
     */
    public function setEndNode($node) {
        $this->endNode = $node;
    }
}