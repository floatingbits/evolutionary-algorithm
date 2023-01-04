<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;
/**
 * @todo: consider to remove this because YAGNI
 */
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