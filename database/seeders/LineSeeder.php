<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$lines = [
			['name' => 'Sombor - Subotica'],
			['name' => 'Sombor - Novi Sad'],
			['name' => 'Sombor - Vrbas'],
			['name' => 'Subotica - Novi Sad'],
			['name' => 'Novi Sad - Beograd'],
			['name' => 'Šid - Beograd'],
			['name' => 'Novi Sad - Zrenjanin'],
			['name' => 'Subotica - Kikinda'],
			['name' => 'Kikinda - Zrenjanin'],
			['name' => 'Beograd - Vršac']
		];

        DB::table('lines')->insert($lines);
    }
}
