<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Tree;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;

class LinkIndexFinder extends AbstractLinkIndexRunner
{
    private ?DirectedLinkInterface $directedLink = null;

    protected function linkReached(DirectedLinkInterface $directedLink) {
        $this->directedLink = $directedLink;
    }

    /**
     * @return DirectedLinkInterface|null
     */
    public function getDirectedLink(): ?DirectedLinkInterface
    {
        return $this->directedLink;
    }

}