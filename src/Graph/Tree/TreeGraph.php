<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Tree;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

/**
 * @template T
 * @template-implements TreeGraphInterface<T>
 */
class TreeGraph implements TreeGraphInterface
{
    /** @var NodeInterface<T> */
    private $rootNode;

    public function __construct(NodeInterface $rootNode) {
        $this->rootNode = $rootNode;
    }

    /**
     * @param FollowLinkCallableInterface $followLinkCallback
     * @param NodeInterface<T>|null $fromNode
     * @return bool
     */
    public function iterateUp(FollowLinkCallableInterface $followLinkCallback, NodeInterface $fromNode = null): bool {
        if (!$fromNode) {
            $fromNode = $this->rootNode;
        }
        $outgoingLinks = $fromNode->getOutgoingLinks();
        $followLinkCallback->startNode($fromNode);
        foreach ($outgoingLinks as $outgoingLink) {
            $nextNode = $outgoingLink->getEndNode();
            if ($followLinkCallback($outgoingLink)) {
                return true;
            }
            if ($this->iterateUp($followLinkCallback, $nextNode)) {
                return true;
            };
        }
        $followLinkCallback->endNode($fromNode);
        return false;
    }

    public function countLinks(): int
    {
        $callable = new class() implements FollowLinkCallableInterface {
            private int $count = 0;
            public function __invoke(DirectedLinkInterface $directedLink): bool {
                $this->count++;
                return false;
            }
            /**
             * @return int
             */
            public function getCount(): int
            {
                return $this->count;
            }
            public function startNode(NodeInterface $node){}
            public function endNode(NodeInterface $node){}
        };
        $this->iterateUp($callable);
        return $callable->getCount();
    }

    /**
     * @return NodeInterface<T>
     */
    public function getRootNode(): NodeInterface
    {
        return $this->rootNode;
    }

    /**
     * @param NodeInterface<T> $rootNode
     */
    public function setRootNode(NodeInterface $rootNode): void
    {
        $this->rootNode = $rootNode;
    }



}