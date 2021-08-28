<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;

/**
 * @template T0 of GenotypeInterface
 * @template T1 of PhenotypeInterface
 */
class Specimen implements SpecimenInterface
{
    /** @var float */
    private $evaluation;
    /** @var T0 */
    private $genotype;
    /** @var EvaluatorInterface<T1> */
    private $evaluator;
    /** @var MutatorInterface<T0> */
    private $mutator;
    /** @var PhenotypeGeneratorInterface<T0,T1> */
    private $phenotypeGenerator;

    public function __construct($evaluator, $mutator, $phenotypeGenerator) {
        $this->evaluator = $evaluator;
        $this->mutator = $mutator;
        $this->phenotypeGenerator = $phenotypeGenerator;
    }

    /**
     * @return T0
     */
    public function getGenotype()
    {
        return $this->genotype;
    }

    /**
     * @param T0 $genotype
     */
    public function setGenotype($genotype): void
    {
        $this->genotype = $genotype;
    }

    /**
     * @return float
     */
    public function getEvaluation():float
    {
        return $this->evaluation;
    }

    /**
     * @param float $evaluation
     */
    public function setEvaluation(float $evaluation): void
    {
        $this->evaluation = $evaluation;
    }

    public function mutate()
    {
        $this->mutator->mutate($this->getGenotype());
    }

    public function evaluate()
    {
        /** @var T1 $phenotype */
        $phenotype = $this->phenotypeGenerator->generatePhenotype($this->getGenotype());
        $evaluation = $this->evaluator->evaluate($phenotype);
        $this->setEvaluation($evaluation);
    }


}