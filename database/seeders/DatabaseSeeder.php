<?php

use Illuminate\Database\Seeder;
use App\Models\Entite;
use App\Models\societe_maintenance;
use App\Models\Agent;
use App\Models\Material;
use App\Models\Maintenance;
use App\Models\Declaration;
use App\Models\Enregistrement;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
    }
}
