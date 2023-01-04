<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Tree;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

/**
 * @template T
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
     * @return void
     */
    public function iterateUp(FollowLinkCallableInterface $followLinkCallback, NodeInterface $fromNode = null) {
        if (!$fromNode) {
            $fromNode = $this->rootNode;
        }
        $outgoingLinks = $fromNode->getOutgoingLinks();
        foreach ($outgoingLinks as $outgoingLink) {
            $nextNode = $outgoingLink->getEndNode();
            if ($followLinkCallback($outgoingLink)) {
                break;
            }
            $this->iterateUp($followLinkCallback, $nextNode);
        }
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
        };
        $this->iterateUp($callable);
        return $callable->getCount();
    }

    /**
     * @return NodeInterface
     */
    public function getRootNode(): NodeInterface
    {
        return $this->rootNode;
    }


}