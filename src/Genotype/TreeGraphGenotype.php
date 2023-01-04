<?php

namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

class TreeGraphGenotype implements TreeGraphGenotypeInterface
{
    private ?TreeGraphInterface $treeGraph;
    public function equals(GenotypeInterface $otherGenotype): bool
    {
        // TODO: Implement equals() method.
    }

    /**
     * @param TreeGraphInterface|null $treeGraph
     */
    public function setTreeGraph(?TreeGraphInterface $treeGraph): void
    {
        $this->treeGraph = $treeGraph;
    }


    public function getTreeGraph(): TreeGraphInterface
    {
        return $this->treeGraph;
    }



}