<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Line extends Model
{
    use HasFactory;

    public function places()
	{
	   //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
	   return $this->belongsToMany(
	        Place::class,
	        'lines_places',
	        'line_id',
	        'place_id');
	}

	public static function searchTrainLines($from, $to){

		$output = [];

		$direct_lines = DB::select('select line_id FROM lines_places WHERE place_id IN (:from,:to) group by line_id having count(*) = 2', ['from' => $from, 'to' => $to]);

		if(!empty($direct_lines)){
			//get line details
				foreach ($direct_lines as $direct_line) {
					$output[$direct_line->line_id]['line_details'] = Line::find($direct_line->line_id)->toArray();
					$output[$direct_line->line_id]['places'] = Line::find($direct_line->line_id)->places()->get();
				}

		} else {
			// get all lines for $from and $to
		}

		return $output;
	}
}
