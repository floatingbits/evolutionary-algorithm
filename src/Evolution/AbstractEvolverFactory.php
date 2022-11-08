<?php

namespace FloatingBits\EvolutionaryAlgorithm\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;

abstract class AbstractEvolverFactory implements EvolverFactoryInterface
{
    public function createEvolver(): EvolverInterface
    {
        $selector = $this->createSelector();
        $recombinator = $this->createRecombinator();
        $evaluator = $this->createEvaluator();
        $mutator = $this->createMutator();
        $phenotypeGenerator = $this->createPhenotypeGenerator();
        return new Evolver(  $selector,
                                 $recombinator,
                                 $evaluator,
                                 $mutator,
                                 $phenotypeGenerator);
    }

    abstract protected function createSelector(): SelectorInterface;
    abstract protected function createRecombinator(): CollectionRecombinatorInterface;
    abstract protected function createEvaluator(): EvaluatorInterface;
    abstract protected function createMutator(): MutatorInterface;
    abstract protected function createPhenotypeGenerator(): PhenotypeGeneratorInterface;
}