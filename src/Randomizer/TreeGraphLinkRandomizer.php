<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\LinkIndexFinder;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

class TreeGraphLinkRandomizer implements TreeGraphLinkRandomizerInterface
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
    public function fetchRandomLink(TreeGraphInterface $treeGraph): ?DirectedLinkInterface {
        $this->randomizer->setMax($treeGraph->countLinks() - 1);
        $randomLinkIndex = $this->randomizer->randomInt();
        $linkIndexFinder = new LinkIndexFinder($randomLinkIndex);
        $treeGraph->iterateUp($linkIndexFinder);
        return $linkIndexFinder->getDirectedLink();
    }


}