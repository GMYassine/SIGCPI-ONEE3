<?php

use Illuminate\Database\Seeder;
use App\Models\entite;
use App\Models\societe_maintenance;
use App\Models\agent;
use App\Models\material;
use League\Csv\Reader;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        entite::create([
            'nomEntite' => 'AM6/3',
            'libelleEntite' => 'This is an example entity'
        ]);

        agent::create([
            'matricule' => 'jhon-doe',
            'nomAgent' => 'John',
            'prenomAgent' => 'Doe',
            'emploiAgent' => 'Developer',
            'emailAgent' => 'john.doe@example.com',
            'mot_de_passeAgent' => 'johnD@example123',
            'est_admin' => 'true',
            'est_suspender' => 'false',
            'refEntite' => 1
        ]);

        societe_maintenance::create([
            'nomSM' => 'Example Maintenance Company',
            'emailSM' => 'maintenance@example.com',
            'est_actif' => 'true'
        ]);


        // Path to the CSV file
        $filePath = __DIR__ . '/materials.csv';

        // Open the CSV file for reading
        $file = fopen($filePath, 'r');
            // Iterate over CSV records
            while (($record = fgetcsv($file)) !== false) {
                // Insert record into the database using Material model
                material::create([
                    'sousFamille' => $record[0], // Assuming 'Sous famille' is the first column
                    'designation' => $record[1], // Assuming 'Designation article' is the second column
                    'activite' => $record[2], // Assuming 'Activité' is the third column
                    'marque' => $record[3], // Assuming 'Marque' is the fourth column
                    'modelle' => $record[4], // Assuming 'Modèle' is the fifth column
                    'numSerie' => $record[6], // Assuming 'Numéro de Série' is the seventh column
                    'matricule' => "jhon-doe",
                    'NomAdresseSite' => $record[10], // Assuming 'Nom et adresse du site' is the eighth column
                    'contratAcquisition' => $record[11], // Assuming 'Contrat d\'acquisition' is the ninth column
                    'objectif' => $record[12], // Assuming 'Objet' is the tenth column
                    'annee' => $record[13], // Assuming 'Année' is the eleventh column
                    'titulaireMarche' => $record[14], // Assuming 'Titulaire du marché' is the twelfth column
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        // Close the file handle
        fclose($file);
    }
}
