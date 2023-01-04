<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Node;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;

/**
 * @template T
 */
trait DirectedLinksContainerTrait
{

    private \SplObjectStorage $outgoingLinks;
    private \SplObjectStorage $incomingLinks;

    /**
     * @return DirectedLinkInterface<T>[]
     */
    public function getOutgoingLinks(): array
    {
        return array_values(iterator_to_array($this->outgoingLinks));
    }

    /**
     * @param DirectedLinkInterface<T> $directedLink
     */
    public function addOutgoingLink(DirectedLinkInterface $directedLink): void
    {
        $this->outgoingLinks->attach($directedLink, $directedLink);
    }
    /**
     * @param DirectedLinkInterface<T> $directedLink
     */
    public function removeOutgoingLink(DirectedLinkInterface $directedLink): void
    {
        $this->outgoingLinks->detach($directedLink);
    }

    /**
     * @return DirectedLinkInterface<T>[]
     */
    public function getIncomingLinks(): array
    {
        return array_values(iterator_to_array($this->incomingLinks));
    }

    /**
     * @param DirectedLinkInterface<T> $directedLink
     */
    public function addIncomingLink(DirectedLinkInterface $directedLink): void
    {
        $this->incomingLinks->attach($directedLink, $directedLink);
    }
    /**
     * @param DirectedLinkInterface<T> $directedLink
     */
    public function removeIncomingLink(DirectedLinkInterface $directedLink): void
    {
        $this->incomingLinks->detach($directedLink);
    }

}