<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Node;

/**
 * @template T
 */
interface NodeInterface extends IncomingLinksInterface, OutgoingLinksInterface
{
    /**
     * @return T
     */
    public function getContent();

    /**
     * @param T $content
     * @return void
     */
    public function setContent($content);
}