<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Place;

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
				$i = 0;

				foreach ($direct_lines as $direct_line) {
					$direct_line_details = Line::find($direct_line->line_id);
					$output[$i][0]['line_details'] = $direct_line_details->toArray();
					$output[$i][0]['places'] = $direct_line_details->places()->get();
					$i++;
				}
		} else {
			// get all lines passing through $from or $to
			$lines = DB::select('select line_id, place_id FROM lines_places WHERE place_id IN (:from,:to)', ['from' => $from, 'to' => $to]);

			if (!empty($lines)) {
				//get lines details and all places for each line
					$lines_with_places = [];
					$lines_data = [];

					foreach ($lines as $line) {
						$line_details = Line::find($line->line_id);
						$lines_data[$line->line_id]['line_details'] = $line_details->toArray();
						$lines_data[$line->line_id]['line_places'] = $line_details->places()->get();

						$lines_with_places[$line->place_id][$line->line_id]['line_details'] = $lines_data[$line->line_id]['line_details'];
						$lines_with_places[$line->place_id][$line->line_id] = $lines_data[$line->line_id]['line_places'];
					}

					$connected_places = [];

					if(!empty($lines_with_places)){
						foreach ($lines_with_places as $place_id => $lines) {
							if(!empty($lines)){
								foreach ($lines as $line_id => $places) {
									if(!empty($places)){
										foreach ($places as $place) {
											$place_details = $place->toArray();

											if($place_details['id'] != $place_id && !in_array($place_details['id'], $connected_places)){
												$connected_places[$place_id][] = $place_details['id'];
											}
										}
									}
								}
							}
						}
					}


					if(!empty($connected_places[$from]) && !empty($connected_places[$to])){
						$intersections = array_intersect($connected_places[$from], $connected_places[$to]);
					}

					if(!empty($intersections)){
						$line_intersections = array_values($intersections);

						if(!empty($line_intersections)){
							$transfer_lines = [];
							$i = 0;
							$j = 0;

							foreach ($line_intersections as $line_intersection) {
								// get lines between $from and $intersection
									$transfer_line = DB::select('select line_id FROM lines_places WHERE place_id IN (:from,:intersection) group by line_id having count(*) = 2', ['from' => $from, 'intersection' => $line_intersection]);

									if (!empty($transfer_line)) {
										foreach ($transfer_line as $transfer_line_item) {
											$transfer_lines[$from][$line_intersection][] = $transfer_line_item->line_id;
										}	
									}

								// get lines between $intersection and $to
									$transfer_line = DB::select('select line_id FROM lines_places WHERE place_id IN (:intersection,:to) group by line_id having count(*) = 2', ['intersection' => $line_intersection, 'to' => $to]);

									if (!empty($transfer_line)) {
										foreach ($transfer_line as $transfer_line_item) {
											$transfer_lines[$line_intersection][$to][] = $transfer_line_item->line_id;
										}	
									}
							}

							// get possible paths
								if(!empty($transfer_lines[$from])){
									foreach ($transfer_lines[$from] as $intersection => $transfer_line) {
										$j = 0;
										foreach ($transfer_line as $key => $value) {
											$output[$i][$j]['line_details'] = $lines_data[$value]['line_details'];
											$output[$i][$j]['places'] = $lines_data[$value]['line_places'];
											$j++;

											if(!empty($transfer_lines[$intersection][$to][$key])){
												$output[$i][$j]['line_details'] = $lines_data[$transfer_lines[$intersection][$to][$key]]['line_details'];
												$output[$i][$j]['places'] = $lines_data[$transfer_lines[$intersection][$to][$key]]['line_places'];
												$j++;
											}

											$i++;
										}
									}
								}
						}
					} else {
						$connected_places = [];

						if(!empty($lines_with_places)){
							foreach ($lines_with_places as $place_id => $lines) {
								if(!empty($lines)){
									foreach ($lines as $line_id => $places) {
										if(!empty($places)){
											foreach ($places as $place) {
												$place_details = $place->toArray();

												if($place_details['id'] != $place_id && !in_array($place_details['id'], $connected_places)){
													$connected_places[$place_id][$line_id][] = $place_details['id'];
												}
											}
										}
									}
								}
							}
						}

						$trajectory = [];
						foreach ($connected_places[$from] as $from_line_id => $from_places) {
							foreach ($from_places as $from_key => $from_place) {
								foreach ($connected_places[$to] as $to_line_id => $to_places) {
									foreach ($to_places as $to_key => $to_place) {
										$connections = DB::select('select line_id FROM lines_places WHERE place_id IN (:from,:to) group by line_id having count(*) = 2', ['from' => $from_place, 'to' => $to_place]);

										if(!empty($connections)){
											$trajectory[$from . '_' . $from_place] = $from_line_id;

											foreach ($connections as $connection) {
												$trajectory[$from_place . '_' . $to_place] = $connection->line_id;
											}

											$trajectory[$to_place . '_' . $to] = $to_line_id;
										}
									}
								}
							}
						}

						if(!empty($trajectory)){
							$j = 0;

							foreach ($trajectory as $key => $value) {
								if(!array_key_exists($value, $lines_data)){
									$line_details = Line::find($value);
									$lines_data[$value]['line_details'] = $line_details->toArray();
									$lines_data[$value]['line_places'] = $line_details->places()->get();
								}

								$output[0][$j]['line_details'] = $lines_data[$value]['line_details'];
								$output[0][$j]['places'] = $lines_data[$value]['line_places'];
								$j++;
							}

						}
					}
			}
		}

		return $output;
	}
}
