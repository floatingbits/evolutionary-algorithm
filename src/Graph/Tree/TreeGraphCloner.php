<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Tree;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

class TreeGraphCloner implements FollowLinkCallableInterface
{
    private ?NodeInterface $currentClonedStartNode = null;
    private ?NodeInterface $clonedRootNode = null;
    /** @var DirectedLinkInterface[]  */
    private array $currentPath = [];
    private TreeGraphInterface $treeGraphClone;
    public function getClonedTreeGraph(TreeGraphInterface $treeGraph) {
        $this->treeGraphClone = clone $treeGraph;
        $treeGraph->iterateUp($this);
        $this->treeGraphClone->setRootNode($this->clonedRootNode);
        return $this->treeGraphClone;
    }
    public function __invoke(DirectedLinkInterface $directedLink): bool
    {
        $clonedLink = clone $directedLink;
        $clonedLink->setStartNode($this->currentClonedStartNode);
        $this->currentClonedStartNode->addOutgoingLink($clonedLink);
        $this->currentPath[] = $clonedLink;
        return false;
    }

    public function startNode(NodeInterface $node) {
        $this->currentClonedStartNode = clone $node;
        $this->currentClonedStartNode->removeAllOutgoingLinks();
        $this->currentClonedStartNode->removeAllIncomingLinks();
        if (sizeof($this->currentPath)) {
            /** @var DirectedLinkInterface $link */
            $link = end($this->currentPath);
            $link->setEndNode($this->currentClonedStartNode);
            $this->currentClonedStartNode->addIncomingLink($link);
        }
        else {
            if (!$this->clonedRootNode) {
                $this->clonedRootNode = $this->currentClonedStartNode;
            }
        }
    }
    public function endNode(NodeInterface $node) {
        $currentLink = array_pop($this->currentPath);
        if ($currentLink) {
            $this->currentClonedStartNode = $currentLink->getStartNode();
        }
    }


}