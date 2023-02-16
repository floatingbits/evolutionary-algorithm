<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;

class SimpleDirectedLink implements DirectedLinkInterface
{
    use DirectedLinkTrait;
    public function __clone()
    {
        $this->startNode = clone $this->startNode;
        $this->endNode = clone $this->endNode;
    }
}