<?php

namespace FloatingBits\EvolutionaryAlgorithm\Genotype;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphCloner;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

/**
 * @template T
 * @template-implements TreeGraphGenotypeInterface<T>
 */
class TreeGraphGenotype implements TreeGraphGenotypeInterface
{
    private ?TreeGraphInterface $treeGraph;
    public function equals(GenotypeInterface $otherGenotype): bool
    {
        // TODO: Implement equals() method.
    }

    public function __clone()
    {
        $cloner = new TreeGraphCloner();
        $this->treeGraph = $cloner->getClonedTreeGraph($this->getTreeGraph());
    }

    /**
     * @param TreeGraphInterface<T>|null $treeGraph
     */
    public function setTreeGraph(?TreeGraphInterface $treeGraph): void
    {
        $this->treeGraph = $treeGraph;
    }

    /**
     * @return TreeGraphInterface<T>
     */
    public function getTreeGraph(): TreeGraphInterface
    {
        return $this->treeGraph;
    }



}