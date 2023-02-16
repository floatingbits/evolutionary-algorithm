<?php

namespace FloatingBits\EvolutionaryAlgorithm\Mutation\Graph;

use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\LinkIndexFinder;
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

    public function __construct(
        TreeGraphLinkRandomizerInterface $linkRandomizer,
        TreeGraphNodeRandomizerInterface $nodeRandomizer
    )
    {
        $this->linkRandomizer = $linkRandomizer;
        $this->nodeRandomizer = $nodeRandomizer;
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
        $chosenRandomLink = $this->linkRandomizer->fetchRandomLink($treeGraph);
        $chosenRandomLink->getStartNode()->removeOutgoingLink($chosenRandomLink);
        $nodeToAttachTo = $this->nodeRandomizer->fetchRandomNode($treeGraph);
        $chosenRandomLink->setStartNode($nodeToAttachTo);
        $nodeToAttachTo->addOutgoingLink($chosenRandomLink);
    }

}