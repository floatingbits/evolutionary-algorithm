<?php

namespace FloatingBits\EvolutionaryAlgorithm\Mutation\Graph;

use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\LinkIndexFinder;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraph;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphCloner;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphLinkRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphNodeRandomizerInterface;

/**
 * @template-implements MutatorInterface<TreeGraphGenotypeInterface>
 */
class SwitchBranchesTreeGraphMutator implements MutatorInterface
{
    private TreeGraphLinkRandomizerInterface $linkRandomizer;
    private TreeGraphNodeRandomizerInterface $nodeRandomizer;
    private bool $copyInsteadOfSwitch;

    public function __construct(
        TreeGraphLinkRandomizerInterface $linkRandomizer,
        TreeGraphNodeRandomizerInterface $nodeRandomizer,
        bool $copyInsteadOfSwitch = false
    )
    {
        $this->linkRandomizer = $linkRandomizer;
        $this->nodeRandomizer = $nodeRandomizer;
        $this->copyInsteadOfSwitch = $copyInsteadOfSwitch;
    }

    /**
     * @param TreeGraphGenotypeInterface $genotype
     * @return GenotypeInterface
     */
    public function mutate($genotype)
    {
        $returnGenotype = clone $genotype;
        $treeGraph = $returnGenotype->getTreeGraph();
        $this->switchRandomLink($treeGraph);
        return $returnGenotype;
    }

    private function switchRandomLink(TreeGraphInterface $treeGraph):void {
        if (!$treeGraph->countLinks()) {
            return;
        }
        $chosenRandomLink = $this->linkRandomizer->fetchRandomLink($treeGraph);
        if ($this->copyInsteadOfSwitch) {
            //Make sure we are working on copies.
            $chosenRandomLink = clone $chosenRandomLink;
            $startNode = clone $chosenRandomLink->getStartNode();
            //Make sure, our link is the only outgoing one on this node
            $startNode->removeAllIncomingLinks();
            $startNode->removeAllOutgoingLinks();
            $startNode->addOutgoingLink($chosenRandomLink);
            $chosenRandomLink->setStartNode($startNode);
            //Use TreeGraphCloner by making a temporary TreeGraph
            $copyBranchTreeGraph = new TreeGraph($chosenRandomLink->getStartNode());
            $cloner = new TreeGraphCloner();
            $clonedTreeGraph = $cloner->getClonedTreeGraph($copyBranchTreeGraph);
            //Now we have a completely cloned version of the original branch
            $chosenRandomLink = $clonedTreeGraph->getRootNode()->getOutgoingLinks()[0] ?? null;
        }
        else {
            $chosenRandomLink->getStartNode()->removeOutgoingLink($chosenRandomLink);
        }
        $nodeToAttachTo = $this->nodeRandomizer->fetchRandomNode($treeGraph);
        $chosenRandomLink->setStartNode($nodeToAttachTo);
        $nodeToAttachTo->addOutgoingLink($chosenRandomLink);
    }

}