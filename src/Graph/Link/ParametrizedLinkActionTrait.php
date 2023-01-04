<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Link;
/**
 * @template T
 */
trait ParametrizedLinkActionTrait
{
    /**
     * @var T
     */
    private $parameterSet;

    /**
     * @return T
     */
    public function getParameterSet()
    {
        return $this->parameterSet;
    }

    /**
     * @param T $parameterSet
     */
    public function setParameterSet($parameterSet): void
    {
        $this->parameterSet = $parameterSet;
    }

}