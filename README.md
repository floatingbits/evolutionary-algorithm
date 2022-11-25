# Evolutionary Algorithm
This is a PHP library helping you to implement solutions to problems that might need a bit of heuristics
and/or creativity:)  



## Usage
You can find a very basic example of a php script you can simply run from the command line in the
'examples' folder in the root of this repository. It will print its results to the console. Feel free to modify some 
hard coded parameters to your needs.

### Solving your own problems
Have a look at the src/Example folder and find some guidance regarding the development of your own solutions to a
problem you may have in mind.

The "Structure" section of this document will give you some hints about what the classes mean in detail. 

## Structure

### /examples
Here, some (or one a the time of writing) example scripts are residing. Run them on the commandline or have a look 
inside to see what is necessary to run the algorithm. 

### /src
The actual library's files. I will continue in the order of the algorithm, 
from the outermost structure to the innermost. 
#### /src/Evolution
You will find **Evolver** and **Tournament** interfaces and default implementations here.
A **Tournament** is a multiple run of the evolutionary process, that keeps track of a set of **Specimen**,
which is modified throughout this process. A developer using this library will not need to write their own 
implementations here, but they will need to provide the necessary components that are injected.  
An **Evolver** has got all the necessary component implementations to run the individual evolutionary process consisting
of **Selection**, **Mutation** and **Recombination** (in the default implementation).
#### /src/Specimen
A collection of **Specimen** will be transformed throughout the process of evolution during a tournament. A specimen
holds a problem specific **Genotype** which will be evaluated to a **Fitness** value, that is also stored inside of the
specimen. The only thing a developer needs to implement for a new problem is a **SpecimenGenerator**,
that builds the initial set of specimen and has the knowledge of what kind of **Genotype** they need to solve the
problem.
#### /src/Genotype
A **Genotype** represents the solution of a problem in the form of a genetical code, that certain operations
(**Mutation** and **Recombination** to be concrete) can be applied to so that the solution space can be explored.
For a user of this library to implement their own algorithm, they will need their own kind of **Genotype**,
but there is a chance that a SymbolArrayGenotype< int|float|whatever > will do the job.
#### /src/Phenotype
A **Phenotype** is a "real world representation" of the genetic code that can be evaluated by an **Evaluator**.
In most implementations of an evolutionary algorithms the abstraction between **Genotype** an **Phenotype** is skipped
and the **Genotype** is evaluated directly, but we will keep it here, because I have some creative tasks in mind where
the abstraction makes sense. 

In my AssignJobToMachinesExample the **Phenotype** makes most of the implementation of the actual problem. For a user's
own implementation it will just be necessary that the **Phenotype** class can accept the **Genotype** as input and the
evaluator can accept the **Phenotype**.
#### /src/Evaluation
An **Evaluator** is supposed to - well - evaluate a phenotype. Depending on where the borderline between **Genotype**,
**Phenotype** and **Evaluator** is drawn, a main part of the work implementing a user's problem might fit in here.  
Since in my AssignJobToMachinesExample the implementation work is done mainly in the Phenotype, there is not much
work left for the evaluator and thus it can be done by a generic and reusable implementation.

#### /src/Mutation
**Mutators** are one of the two mechanisms to modify a **Specimen**'s **Genotype** to explore the solution space. They
work by randomly modifying pieces of the genetic code.   
A **Mutator** needs to know the interface of the used **Genotype** class, so whenever a user needs their own genetic 
representation, matching **Mutators** will be needed.

#### /src/Recombination
Almost everything said about **Mutators** in the paragraph above is valid for a **Recombinator**, but a **Recombinator**
works by taking two **Genotypes** and interbreed them.

#### /src/Randomizer
A lot in this algorithm is based on randomness. To help harnessing and controlling that randomness and
for testing purposes there are the randomizer classes.

#### /src/Example
You can find above structure in each of the examples subfolders if problem specific implementations are needed.




