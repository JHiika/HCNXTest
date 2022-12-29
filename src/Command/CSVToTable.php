<?php

namespace App\Command;

use PDO;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CSVToTable extends Command
{
    protected static $defaultName = "app.csvtotable";

    protected function configure():void
    {
        $this->setName("csvToTable")
            ->setDescription("Transform CSV files into a table with no duplicate data")
            ->setHelp('This command transform a CSV file into a php table with no duplication of data');
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        // Open CSV file in read function
            $csvFile = fopen('contact.csv', 'r');

        // Read and delete the first line (columns name)
            fgetcsv($csvFile);

        // Loop on each line of CSV
            while (($row = fgetcsv($csvFile, null, ';', '"')) !== FALSE) {
                // Insert phone numbers and donations amount in the DB table 1 (numero_dons)
                    $db = new PDO('mysql:host=localhost:3308;dbname=test', 'root', 'root');

                    // Create request (If we have a duplicate key, then add all amounts and update)
                        $stmt = $db->prepare("INSERT INTO numero_dons (numero, montant) VALUES (:val1, :val2)
                        ON DUPLICATE KEY UPDATE montant = montant+:val2");

                    // Add values to the request
                        $stmt->bindValue(':val1', $row[2]);
                        $stmt->bindValue(':val2', $row[1]);

                    // Execute the request
                        $stmt->execute();

                // Insert phone numbers and zipcode in the DB table 2 (numero_zipcode)
                        $db = new PDO('mysql:host=localhost:3308;dbname=test', 'root', 'root');

                    // Create request (If we have a duplicate key, then update the zipcode)
                        $stmt = $db->prepare("INSERT INTO numero_zipcode (numero, zipcode)
                        VALUES (:val1, :val2)
                        ON DUPLICATE KEY UPDATE id = id;");

                    // Add values to the request
                        $stmt->bindValue(':val1', $row[2]);
                        $stmt->bindValue(':val2', $row[3]);

                    // Execute the requst
                        $stmt->execute();
            }

        // Close CSV file
            fclose($csvFile);

        // Return an int to make the command successful
            return Command::SUCCESS;
    }
}