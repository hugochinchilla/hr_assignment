# About this project

This project has been addressed from a DDD point of view, instead of modelling the data model puting the database in the center, I have identified the relevant business entities and defined an aggregate root (the Department).

I started by defining the entities and roles in code, ensuring no infrastructure details leak to the domain. For example, you won't find any reference to the department ID on the employee class as this is a detail of how relational databases work and this is hidden from the application by the DbalDepartmentRepository.

## Starting without infrastructure, then adding it

I have used TDD to guide the creation of the domain code, and the execution of the reports has been modelled entirely in code using TDD, without interacting with a database, filtering is done in memory at first.

This allows me to define and test the business rules using only code, once I'm satisfied with the result I will create a new implementation that uses mysql as a backend and reuse the tests created for the first implementation to verify its correctness.

This allows for an application that can be easily changed, and it's not tied to any particular technology.

## What this application can do

 - Add departments
 - Add employees to departments
 - Execute department reports

## What this application can't do

 - Update departments
 - Update employees
 - Move employees between departments

If you want to see any of these features implemented, ask for it and it will be done.

## What I would do if I had more time or fewer constraints

 - I would have a system to automate database migrations to handle the creation of the tables.
 - I would not optimize the DBAL repository implementation, instead I would use doctrine to create a simpler/faster implementation.
