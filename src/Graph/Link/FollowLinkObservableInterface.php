<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;

interface FollowLinkObservableInterface
{
    public function addObserver(FollowLinkObserverInterface $observer);
    public function removeObserver(FollowLinkObserverInterface $observer);
    public function followLink(DirectedLinkInterface $directed);
}