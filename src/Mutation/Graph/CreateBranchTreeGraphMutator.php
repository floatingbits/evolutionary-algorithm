<?php

namespace FloatingBits\EvolutionaryAlgorithm\Mutation\Graph;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphNodeRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
/**
 * @template-implements MutatorInterface<TreeGraphGenotypeInterface>
 */
class CreateBranchTreeGraphMutator implements MutatorInterface
{
    private TreeGraphRandomizerInterface $treeGraphRandomizer;
    private TreeGraphNodeRandomizerInterface $nodeRandomizer;

    public function __construct(TreeGraphRandomizerInterface $treeGraphRandomizer, TreeGraphNodeRandomizerInterface $nodeRandomizer)
    {
        $this->treeGraphRandomizer = $treeGraphRandomizer;
        $this->nodeRandomizer = $nodeRandomizer;
    }

    /**
     * @param $genotype
     * @return mixed
     */
    public function mutate($genotype)
    {
        $returnGenotype = clone $genotype;
        $treeGraph = $returnGenotype->getTreeGraph();
        $newBranchTreeGraph = $this->treeGraphRandomizer->randomTreeGraph();
        $rootNode = $newBranchTreeGraph->getRootNode();

        $nodeToAttachTo = $this->nodeRandomizer->fetchRandomNode($treeGraph);
        foreach ($rootNode->getOutgoingLinks() as $outgoingLink) {
            $outgoingLink->setStartNode($nodeToAttachTo);
            $nodeToAttachTo->addOutgoingLink($outgoingLink);
        }
        return $returnGenotype;
    }

}