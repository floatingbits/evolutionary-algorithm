<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\CollectionReplenishInterface;

abstract class AbstractEvolverFactory implements EvolverFactoryInterface
{
    public function createEvolver(): EvolverInterface
    {
        $selector = $this->createSelector();
        $evaluator = $this->createEvaluator();
        $replenishers = $this->createReplenishers();
        $creativeReplenishers = $this->createCreativeReplenishers();
        $phenotypeGenerator = $this->createPhenotypeGenerator();
        return new Evolver(
                            $selector,
                            $replenishers,
                            $evaluator,
                            $phenotypeGenerator,
                            $creativeReplenishers
        );
    }

    abstract protected function createSelector(): SelectorInterface;
    abstract protected function createEvaluator(): EvaluatorInterface;

    /**
     * @return CollectionReplenishInterface[]
     */
    abstract protected function createReplenishers(): array;
    protected function createCreativeReplenishers(): array {
        return [];
    }
    abstract protected function createPhenotypeGenerator(): PhenotypeGeneratorInterface;
}