<?php

namespace FloatingBits\EvolutionaryAlgorithm\Mutation\Graph;

use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphLinkRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;

/**
 * @template-implements MutatorInterface<TreeGraphGenotypeInterface>
 */
class CutBranchTreeGraphMutator implements MutatorInterface
{
    private TreeGraphLinkRandomizerInterface $linkRandomizer;
    public function __construct(TreeGraphLinkRandomizerInterface $linkRandomizer)
    {
        $this->linkRandomizer = $linkRandomizer;
    }

    /**
     * @param $genotype
     * @return mixed
     */
    public function mutate($genotype)
    {
        $returnGenotype = clone $genotype;
        $treeGraph = $returnGenotype->getTreeGraph();
        $this->cutRandomLink($treeGraph);
        return $returnGenotype;
    }

    /**
     * @param TreeGraphInterface $treeGraph
     * @return void
     */
    private function cutRandomLink(TreeGraphInterface $treeGraph):void
    {
        if ($treeGraph->countLinks()) {
            $chosenRandomLink = $this->linkRandomizer->fetchRandomLink($treeGraph);
            $chosenRandomLink->getStartNode()->removeOutgoingLink($chosenRandomLink);
        }

    }

}