<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Mutation\Graph;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotype;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\SimpleDirectedLink;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\SimpleNode;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraph;
use FloatingBits\EvolutionaryAlgorithm\Mutation\Graph\SwitchBranchesTreeGraphMutator;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use PHPUnit\Framework\TestCase;

class SwitchBranchesTreeGraphMutatorTest extends TestCase
{
    public function testSwitchBranch() {
        $randomizer = $this->createMock(IntRandomizer::class);
        $randomizer->method('randomInt')->willReturnOnConsecutiveCalls(0,1);
        $mutator = new SwitchBranchesTreeGraphMutator($randomizer);

        $rootNode = $this->createNode(0);
        $secondNode = $this->createNode(1);
        $thirdNode = $this->createNode(2);
        $fourthNode = $this->createNode(3);

        $link1 = $this->linkNodes($rootNode, $secondNode);
        $link2 = $this->linkNodes($rootNode, $thirdNode);
        $link3 = $this->linkNodes($rootNode, $fourthNode);

        $treeGraph = new TreeGraph($rootNode);
        $treeGraphGenotype = new TreeGraphGenotype();
        $treeGraphGenotype->setTreeGraph($treeGraph);

        $this->assertCount(3, $rootNode->getOutgoingLinks());
        $this->assertCount(0, $fourthNode->getOutgoingLinks());
        $mutator->mutate($treeGraphGenotype);
        $this->assertCount(2, $rootNode->getOutgoingLinks());
        $this->assertCount(1, $fourthNode->getOutgoingLinks());


    }
    private function createNode($content): NodeInterface {
        $node = new SimpleNode();
        $node->setContent($content);
        return $node;
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