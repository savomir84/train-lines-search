<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinePlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$lines_places = [
			['line_id' => 1, 'place_id' => 1],
			['line_id' => 1, 'place_id' => 2],
			['line_id' => 1, 'place_id' => 3],
			['line_id' => 1, 'place_id' => 4],
			['line_id' => 1, 'place_id' => 5],
			['line_id' => 2, 'place_id' => 1],
			['line_id' => 2, 'place_id' => 6],
			['line_id' => 2, 'place_id' => 7],
			['line_id' => 2, 'place_id' => 8],
			['line_id' => 2, 'place_id' => 9],
			['line_id' => 2, 'place_id' => 10],
			['line_id' => 2, 'place_id' => 11],
			['line_id' => 3, 'place_id' => 1],
			['line_id' => 3, 'place_id' => 12],
			['line_id' => 3, 'place_id' => 13],
			['line_id' => 3, 'place_id' => 14],
			['line_id' => 3, 'place_id' => 15],
			['line_id' => 3, 'place_id' => 16],
			['line_id' => 3, 'place_id' => 17],
			['line_id' => 4, 'place_id' => 5],
			['line_id' => 4, 'place_id' => 18],
			['line_id' => 4, 'place_id' => 19],
			['line_id' => 4, 'place_id' => 17],
			['line_id' => 4, 'place_id' => 20],
			['line_id' => 4, 'place_id' => 21],
			['line_id' => 4, 'place_id' => 11],
			['line_id' => 5, 'place_id' => 11],
			['line_id' => 5, 'place_id' => 22],
			['line_id' => 5, 'place_id' => 23],
			['line_id' => 5, 'place_id' => 24],
			['line_id' => 5, 'place_id' => 25],
			['line_id' => 5, 'place_id' => 26],
			['line_id' => 5, 'place_id' => 27],
			['line_id' => 5, 'place_id' => 28],
			['line_id' => 5, 'place_id' => 29],
			['line_id' => 6, 'place_id' => 30],
			['line_id' => 6, 'place_id' => 31],
			['line_id' => 6, 'place_id' => 32],
			['line_id' => 6, 'place_id' => 33],
			['line_id' => 6, 'place_id' => 26],
			['line_id' => 7, 'place_id' => 11],
			['line_id' => 7, 'place_id' => 34],
			['line_id' => 7, 'place_id' => 35],
			['line_id' => 7, 'place_id' => 36],
			['line_id' => 7, 'place_id' => 37],
			['line_id' => 8, 'place_id' => 39],
			['line_id' => 8, 'place_id' => 38],
			['line_id' => 8, 'place_id' => 40],
			['line_id' => 8, 'place_id' => 37],
			['line_id' => 9, 'place_id' => 29],
			['line_id' => 9, 'place_id' => 41],
			['line_id' => 9, 'place_id' => 42],
			['line_id' => 9, 'place_id' => 43],
			['line_id' => 9, 'place_id' => 44],
			['line_id' => 10, 'place_id' => 29],
			['line_id' => 10, 'place_id' => 45],
			['line_id' => 10, 'place_id' => 46],
			['line_id' => 10, 'place_id' => 47],
			['line_id' => 10, 'place_id' => 48],
			['line_id' => 10, 'place_id' => 49],
			['line_id' => 10, 'place_id' => 50],
			['line_id' => 10, 'place_id' => 51],
			['line_id' => 10, 'place_id' => 52]
		];

        DB::table('lines_places')->insert($lines_places);
    }
}
