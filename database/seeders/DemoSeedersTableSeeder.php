<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DemoSeeder;

class DemoSeedersTableSeeder extends Seeder
{
    /**
     * Run the database seed
     *
     * @return void
     */
	public function run()
	{
		$csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'demoSeeders.csv';
        $items = csv_to_array($csvPath);

        foreach ($items as $key => $item)
        {
            DemoSeeder::create([

            ]);
        }
	}
}
