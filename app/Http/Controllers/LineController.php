<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Line;

class LineController extends Controller
{
    public function index()
    {
        return view('index', [
            'places' => Place::all()->sortBy("name")
        ]);
    }

    public function search(Request $request)
    {
		$response = '';

        $data = $request->all();

		$validation_result = ['status' => 'success', 'message' => []];

		// validate search parameters
			if(empty($data['from'])){
				$validation_result['status'] = 'error';
				$validation_result['message'][] = 'Please select start station.';
			}

			if(empty($data['to'])){
				$validation_result['status'] = 'error';
				$validation_result['message'][] = 'Please select end station.';
			}

			if($validation_result['status'] != 'error' && $data['from'] == $data['to']){
				$validation_result['status'] = 'error';
				$validation_result['message'][] = 'You have selected same station for start and end of your journey.';
			}

		// search line
			if($validation_result['status'] == 'success'){
				$lines = Line::searchTrainLines($data['from'], $data['to']);
				$response = view('lines/search', ['lines' => $lines, 'search_parameters' => $data])->render();
			} else {
				$response = view('lines/search', ['validation_result' => $validation_result])->render();
			}

        return response()->json($response);
    }
}
