<?php
use \FloatingBits\EvolutionaryAlgorithm\Evolution\Tournament;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\AssignJobToMachinesEvolverFactory;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use \FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Specimen\SpecimenGenerator;

require_once '../vendor/autoload.php';
$jobs = [];
$jobs[] = new Job(33.1);
$jobs[] = new Job(115.1);
$jobs[] = new Job(27.1);
$jobs[] = new Job(147.1);
$jobs[] = new Job(10.1);
$jobs[] = new Job(13.5);
$jobs[] = new Job(8.1);
$jobs[] = new Job(0.2);
$jobs[] = new Job(30.3);
$jobs[] = new Job(2.1);
$jobs[] = new Job(0.4);
$jobs[] = new Job(32.2);
$jobs[] = new Job(113.1);
$jobs[] = new Job(47.1);
$jobs[] = new Job(34.2);
$jobs[] = new Job(2.2);
$jobs[] = new Job(42.1);
$jobs[] = new Job(131.4);
$jobs[] = new Job(42.2);
$factory = new AssignJobToMachinesEvolverFactory($jobs);
$evolver = $factory->createEvolver();
$numMachines = 5;
$specimenGenerator = new SpecimenGenerator(count($jobs), $numMachines);
$tournament = new Tournament($evolver, $specimenGenerator);
$tournament->setup(50);
$winnerPopulation = $tournament->getSpecimenCollection();
printPopulation($winnerPopulation);

for ($i = 0; $i < 1000; $i++) {
    print('Running 100 rounds' . "\n");
    $tournament->runTournament(5);
    $winnerPopulation = $tournament->getSpecimenCollection();
    printPopulation($winnerPopulation, 5);
}

function printPopulation(\FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection $population, $max = 0) {
    /** @var \FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface $specimen */
    $population->sortByFitness();
    foreach ($population as $key => $specimen) {
        if ($max && $key >= $max) {
            break;
        }
        /** @var \FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Genotype\Genotype $genotype */
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