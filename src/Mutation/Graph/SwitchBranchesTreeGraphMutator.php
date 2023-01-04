<?php

namespace FloatingBits\EvolutionaryAlgorithm\Mutation\Graph;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\LinkIndexFinder;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizerInterface;

/**
 * @template-implements MutatorInterface<TreeGraphGenotypeInterface>
 */
class SwitchBranchesTreeGraphMutator implements MutatorInterface
{
    private ConfigurableIntRandomizerInterface $randomizer;
    public function __construct(ConfigurableIntRandomizerInterface $randomizer)
    {
        $this->randomizer = $randomizer;
    }

    /**
     * @param TreeGraphGenotypeInterface $genotype
     * @return void
     */
    public function mutate($genotype)
    {
        $treeGraph = $genotype->getTreeGraph();
        $this->switchRandomLink($treeGraph);
    }

    private function switchRandomLink(TreeGraphInterface $treeGraph):void {
        $chosenRandomLink = $this->fetchRandomLink($treeGraph);
        $chosenRandomLink->getStartNode()->removeOutgoingLink($chosenRandomLink);
        $nodeToAttachTo = $this->fetchRandomNodeToAttachTo($treeGraph);
        $chosenRandomLink->setStartNode($nodeToAttachTo);
        $nodeToAttachTo->addOutgoingLink($chosenRandomLink);
    }

    private function fetchRandomLink(TreeGraphInterface $treeGraph): DirectedLinkInterface {
        $this->randomizer->setMin(0);
        $this->randomizer->setMax($treeGraph->countLinks() - 1);
        $randomLinkIndex = $this->randomizer->randomInt();
        $linkIndexFinder = new LinkIndexFinder($randomLinkIndex);
        $treeGraph->iterateUp($linkIndexFinder);
        return $linkIndexFinder->getDirectedLink();
    }

    private function fetchRandomNodeToAttachTo(TreeGraphInterface $treeGraph): NodeInterface {
        $this->randomizer->setMin(-1);
        $this->randomizer->setMax($treeGraph->countLinks() - 1);
        $randomLinkIndex = $this->randomizer->randomInt();
        if ($randomLinkIndex === -1) {
            return $treeGraph->getRootNode();
        }

        $linkIndexFinder = new LinkIndexFinder($randomLinkIndex);
        $treeGraph->iterateUp($linkIndexFinder);
        return $linkIndexFinder->getDirectedLink()->getEndNode();
    }


}