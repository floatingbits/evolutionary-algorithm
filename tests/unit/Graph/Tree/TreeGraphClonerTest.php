<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Graph\Tree;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\SimpleDirectedLink;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\SimpleNode;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\LinkIndexFinder;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraph;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphCloner;
use PHPUnit\Framework\TestCase;

class TreeGraphClonerTest extends TestCase
{
    public function testCloneSuccessful() {
        $rootNode = new SimpleNode();
        $rootNode->setContent('root');
        $node11 = new SimpleNode();
        $node11->setContent('1_1');
        $node12 = new SimpleNode();
        $node12->setContent('1_2');
        $node13 = new SimpleNode();
        $node13->setContent('1_3');
        $node21 = new SimpleNode();
        $node21->setContent('2_1');
        $directedLink1 = $this->linkNodes($rootNode, $node11);
        $directedLink2 = $this->linkNodes($node11, $node12);
        $directedLink3 = $this->linkNodes($node12, $node13);
        $directedLink4 = $this->linkNodes($rootNode, $node21);

        $treeGraph = new TreeGraph($rootNode);

        $cloner = new TreeGraphCloner();

        $clonedTreeGraph = $cloner->getClonedTreeGraph($treeGraph);

        $this->assertNotSame($treeGraph, $clonedTreeGraph);
        $this->assertNotSame($treeGraph->getRootNode(), $clonedTreeGraph->getRootNode());
        $this->assertNotSame($treeGraph->getRootNode()->getOutgoingLinks()[0], $clonedTreeGraph->getRootNode()->getOutgoingLinks()[0]);
        $this->assertEquals($treeGraph->countLinks(), $clonedTreeGraph->countLinks());

        for ($i = 0; $i < $treeGraph->countLinks(); $i++) {
            print "\n\n" . "new index to search " .$i . "\n";
            $linkIndexFinder = new LinkIndexFinder($i);
            $treeGraph->iterateUp($linkIndexFinder);
            $originalLink = $linkIndexFinder->getDirectedLink();
            print  "...\n";
            $linkIndexFinder = new LinkIndexFinder($i);
            $clonedTreeGraph->iterateUp($linkIndexFinder);
            $clonedLink = $linkIndexFinder->getDirectedLink();
            $this->assertNotSame($originalLink, $clonedLink);
            $this->assertNotSame($originalLink->getStartNode(), $clonedLink->getStartNode());
            $this->assertNotSame($originalLink->getEndNode(), $clonedLink->getEndNode());
            $this->assertEquals($originalLink->getStartNode()->getContent(), $clonedLink->getStartNode()->getContent());
            $this->assertEquals($originalLink->getEndNode()->getContent(), $clonedLink->getEndNode()->getContent());
        }

    }

    private function linkNodes(NodeInterface $node1, NodeInterface $node2): DirectedLinkInterface {
        $link = new SimpleDirectedLink();
        $link->setStartNode($node1);
        $node1->addOutgoingLink($link);
        $link->setEndNode($node2);
        $node2->addIncomingLink($link);
        return $link;
    }

}