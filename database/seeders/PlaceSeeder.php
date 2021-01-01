<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$places = [
			['name' => 'Sombor'],
			['name' => 'Svetozar Miletić'],
			['name' => 'Aleksa Šantić'],
			['name' => 'Bajmok'],
			['name' => 'Subotica'],
			['name' => 'Sonta'],
			['name' => 'Bogojevo'],
			['name' => 'Karavukovo'],
			['name' => 'Odžaci'],
			['name' => 'Gajdobra'],
			['name' => 'Novi Sad'],
			['name' => 'Čonoplja'],
			['name' => 'Kljajićevo'],
			['name' => 'Sivac'],
			['name' => 'Kula'],
			['name' => 'Crvenka'],
			['name' => 'Vrbas'],
			['name' => 'Žednik'],
			['name' => 'Bačka Topola'],
			['name' => 'Stepanovićevo'],
			['name' => 'Kisač'],
			['name' => 'Petrovaradin'],
			['name' => 'Sremski Karlovci'],
			['name' => 'Beška'],
			['name' => 'Inđija'],
			['name' => 'Stara Pazova'],
			['name' => 'Nova Pazova'],
			['name' => 'Batajnica'],
			['name' => 'Beograd'],
			['name' => 'Šid'],
			['name' => 'Sremska Mitrovica'],
			['name' => 'Ruma'],
			['name' => 'Golubinci'],
			['name' => 'Rimski Šančevi'],
			['name' => 'Titel'],
			['name' => 'Orlovat'],
			['name' => 'Zrenjanin'],
			['name' => 'Senta'],
			['name' => 'Čoka'],
			['name' => 'Banatsko Miloševo'],
			['name' => 'Kikinda'],
			['name' => 'Novi Bečej'],
			['name' => 'Ovča'],
			['name' => 'Pančevo'],
			['name' => 'Alibunar'],
			['name' => 'Vršac']
		];

        DB::table('places')->insert($places);
    }
}
