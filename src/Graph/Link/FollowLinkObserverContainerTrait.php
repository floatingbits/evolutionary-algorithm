<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;

trait FollowLinkObserverContainerTrait
{
    /**
     * @var FollowLinkObserverInterface[]
     */
    private \SplObjectStorage $observers;

    public function addObserver(FollowLinkObserverInterface $observer) {
        $this->observers->attach($observer);
    }
    public function removeObserver(FollowLinkObserverInterface $observer) {
        $this->observers->detach($observer);
    }
}