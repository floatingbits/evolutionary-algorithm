<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;
/**
 * @template T
 */
interface LinkActionInterface
{
    /**
     * @param T $target
     * @return void
     */
    public function applyAction($target): void;
}