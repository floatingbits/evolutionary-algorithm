<?php
use FloatingBits\EvolutionaryAlgorithm\Evolution\DefaultTournament;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\AssignJobToMachinesEvolverFactory;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Specimen\SpecimenGenerator;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Genotype\Genotype;
require_once '../vendor/autoload.php';
$exampleProblem = new \FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\ExampleProblemInstance();
$jobs = $exampleProblem->getJobs();
$factory = $exampleProblem->getEvolverFactory();
$evolver = $factory->createEvolver();
$specimenGenerator = $exampleProblem->getSpecimenGenerator();
$tournament = new DefaultTournament();
$tournament->setEvolver($evolver);
$tournament->setCleanupAfterNRounds(49);
$tournament->setNumRounds(50);
$tournament->setSpecimenCollection($specimenGenerator->generateSpecimen(50));
$currentPopulation = $tournament->getSpecimenCollection();
printPopulation($currentPopulation);

for ($i = 0; $i < 100; $i++) {
    print('Running 50 rounds' . "\n");
    $tournament->runTournament();
    $currentPopulation = $tournament->getSpecimenCollection();
    printPopulation($currentPopulation, 7);
}

function printPopulation(SpecimenCollection $population, $max = 0) {
    $population->sortByFitness();
    /** @var SpecimenInterface $specimen */
    foreach ($population as $key => $specimen) {
        if ($max && $key >= $max) {
            break;
        }
        /** @var Genotype $genotype */
        $genotype = $specimen->getGenotype();
        print("Specimen " . $key . ": Evaluation " . $specimen->getEvaluation()->getMainFitness());
        print("\n");
        for ($i = 0; $i < $genotype->getSymbolLength(); $i++) {
            $symbol = $genotype->getSymbolAt($i);
            print($symbol->getValue() . ' ');
        }
        print("\n");

    }
    print("\n");
}
