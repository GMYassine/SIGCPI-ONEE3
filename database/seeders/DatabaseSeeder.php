<?php

use Illuminate\Database\Seeder;
use App\Models\entite;
use App\Models\societe_maintenance;
use App\Models\agent;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $entite = entite::create([
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
    }
}
