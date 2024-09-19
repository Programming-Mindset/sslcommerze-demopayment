<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DemoResource;

class DemoResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seed
     *
     * @return void
     */
	public function run()
	{
		$csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'demoResources.csv';
        $items = csv_to_array($csvPath);

        foreach ($items as $key => $item)
        {
            DemoResource::create([

            ]);
        }
	}
}
