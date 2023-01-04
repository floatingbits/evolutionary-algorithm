<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;

interface FollowLinkCallableInterface
{
    /**
     * @param DirectedLinkInterface $directedLink
     * @return bool (return true if you want to stop propagation)
     */
    public function __invoke(DirectedLinkInterface $directedLink): bool;
}