<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;
/**
 * @todo: consider to remove this because YAGNI
 */
/**
 * @template T0
 * @template T1
 * @template-extends LinkActionInterface<T0>
 */

interface ParametrizedLinkActionInterface extends LinkActionInterface
{
    /**
     * @param T1 $parameterSet
     */
    public function setActionParameterSet($parameterSet);

    /**
     * @return T1
     */
    public function getActionParameterSet();
}