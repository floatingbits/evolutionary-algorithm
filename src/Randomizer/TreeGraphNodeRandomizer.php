<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\LinkIndexFinder;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

class TreeGraphNodeRandomizer implements TreeGraphNodeRandomizerInterface
{
    private ConfigurableIntRandomizerInterface $randomizer;
    public function __construct(
        ConfigurableIntRandomizerInterface $randomizer = null
    ) {
        if ($randomizer === null) {
            $randomizer = new IntRandomizer();
        }
        $this->randomizer = $randomizer;
    }
    public function fetchRandomNode(TreeGraphInterface $treeGraph): NodeInterface
    {
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