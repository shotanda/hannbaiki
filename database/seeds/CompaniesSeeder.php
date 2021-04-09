<?php

use Illuminate\Database\Seeder;
use App\models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Company::class,4)->create();
    }
}

