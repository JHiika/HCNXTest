<?php

namespace App\Command;

use PDO;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateBaseTables extends Command
{
    protected static $defaultName = "app.createbasetables";

    protected function configure():void
    {
        $this->setName("CreateBaseTables")
            ->setDescription("Create right tables in the DB")
            ->setHelp('This command create and modify table for the CSV To Table command');
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        // Create tables
            // First table
                $db = new PDO('mysql:host=localhost:3308;dbname=test', 'root', 'root');

                // Request
                $stmt = $db->prepare(" CREATE TABLE numero_dons_3(
                                        id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key', 
                                        numero VARCHAR(15),
                                        montant INT(100) )");

                // Execute the request
                    $stmt->execute();

            // Second table 
                $db = new PDO('mysql:host=localhost:3308;dbname=test', 'root', 'root');

                // Request
                    $stmt = $db->prepare(" CREATE TABLE numero_zipcode_3(
                                            id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key', 
                                            numero VARCHAR(15),
                                            zipcode VARCHAR(15) )");
        
                // Execute the request
                    $stmt->execute();

        // Alter table to add constraints
            // Table 1 (Numero_dons)
                // Connection to DB
                $db = new PDO('mysql:host=localhost:3308;dbname=test', 'root', 'root');

                // Request
                    $stmt = $db->prepare("ALTER TABLE numero_dons ADD CONSTRAINT numero UNIQUE(numero)");

                // Execute the request
                    $stmt->execute();
            // Table 2 (Numero_zipcode)
                // Connection to DB
                $db = new PDO('mysql:host=localhost:3308;dbname=test', 'root', 'root');

                // Request
                    $stmt = $db->prepare("ALTER TABLE numero_zipcode ADD CONSTRAINT numerozip UNIQUE(numero, zipcode)");

                // Execute the request
                    $stmt->execute();
        
        // Return an int to make the command successful
            return Command::SUCCESS;
    }
}