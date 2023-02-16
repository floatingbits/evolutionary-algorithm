<?php

namespace FloatingBits\EvolutionaryAlgorithm\Randomizer;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraph;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;

/**
 * @template T
 * @template-implements TreeGraphRandomizerInterface<T>
 */
class TreeGraphRandomizer implements TreeGraphRandomizerInterface
{
    private ConfigurableIntRandomizerInterface $numLinksRandomizer;
    private TreeGraphNodeRandomizerInterface $nodeRandomizer;
    private NodeFactoryInterface $nodeFactory;
    private DirectedLinkFactoryInterface $linkFactory;

    public function __construct(
        ConfigurableIntRandomizerInterface $numLinksRandomizer,
        TreeGraphNodeRandomizerInterface $nodeRandomizer,
        NodeFactoryInterface $nodeFactory,
        DirectedLinkFactoryInterface $linkFactory
    ) {
        $this->numLinksRandomizer = $numLinksRandomizer;
        $this->nodeRandomizer = $nodeRandomizer;
        $this->nodeFactory = $nodeFactory;
        $this->linkFactory = $linkFactory;
    }

    public function randomTreeGraph()
    {
        $numLinks = $this->numLinksRandomizer->randomInt();
        $rootNode = $this->nodeFactory->createNode();
        $treeGraph = new TreeGraph($rootNode);
        while ($numLinks--) {
            $newNode = $this->nodeFactory->createNode();
            $newLink = $this->linkFactory->createDirectedLink();
            $newLink->setEndNode($newNode);
            $newNode->addIncomingLink($newLink);
            $randomNode = $this->nodeRandomizer->fetchRandomNode($treeGraph);
            $newLink->setStartNode($randomNode);
            $randomNode->addOutgoingLink($newLink);
        }
        return $treeGraph;
    }


}