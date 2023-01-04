<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Tree;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;

abstract class AbstractLinkIndexRunner implements FollowLinkCallableInterface {
    private int $runToIndex;
    private int $currentIndex = 0;
    public function __construct(int $runToIndex)
    {
        $this->runToIndex = $runToIndex;
    }
    public function __invoke(DirectedLinkInterface $directedLink): bool {

        if ($this->runToIndex === $this->currentIndex) {
            $this->linkReached($directedLink);
            return true;
        }
        $this->currentIndex++;
        return false;
    }

    abstract protected function linkReached(DirectedLinkInterface $directedLink);

}