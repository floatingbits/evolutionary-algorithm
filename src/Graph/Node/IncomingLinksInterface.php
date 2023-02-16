<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Node;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;

interface IncomingLinksInterface
{
    public function getIncomingLinks();
    public function removeIncomingLink(DirectedLinkInterface $directedLink): void;
    public function removeAllIncomingLinks(): void;
    public function addIncomingLink(DirectedLinkInterface $directedLink): void;
}