<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Node;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;

interface OutgoingLinksInterface
{
    /**
     * @return DirectedLinkInterface[]
     */
    public function getOutgoingLinks(): array;
    public function removeOutgoingLink(DirectedLinkInterface $directedLink): void;
    public function removeAllOutgoingLinks(): void;
    public function addOutgoingLink(DirectedLinkInterface $directedLink): void;
}