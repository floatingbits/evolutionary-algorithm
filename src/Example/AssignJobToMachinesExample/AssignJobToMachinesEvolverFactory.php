<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\MaxArrayEvaluator;
use FloatingBits\EvolutionaryAlgorithm\Evolution\AbstractEvolverFactory;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Phenotype\PhenotypeGenerator;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\SimpleSymbolArrayMutator;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BooleanRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinator;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Recombination\SymbolArrayCrossoverRecombinator;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SimpleSelector;

class AssignJobToMachinesEvolverFactory extends AbstractEvolverFactory
{
    /** @var Job[] */
    private $jobs;

    /**
     * @param Job[] $jobs
     */
    public function __construct(array $jobs) {
        $this->jobs = $jobs;
    }

    protected function createSelector(): SelectorInterface
    {
        return new SimpleSelector(0.5);
    }

    protected function createRecombinator(): CollectionRecombinatorInterface
    {
        return new CollectionRecombinator(
            new SymbolArrayCrossoverRecombinator(1, new IntRandomizer(), new BooleanRandomizer(), true),
            new IntRandomizer()
        );
    }

    protected function createMutator(): MutatorInterface
    {
        return new SimpleSymbolArrayMutator(new BooleanRandomizer(0.03));
    }

    protected function createEvaluator(): EvaluatorInterface
    {
        return new MaxArrayEvaluator(true);
    }
    protected function createPhenotypeGenerator(): PhenotypeGeneratorInterface
    {

        return new PhenotypeGenerator($this->jobs);
    }


}