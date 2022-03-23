<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Validator;

class ApiWeatherController extends Controller {
    /*
     * 200: success
     * 201 created
     * 204 deleted
     * 401: unauthorized
     * 404: page not found
     * 400: Bad Request
     * 422: Validation error
     * 403: Forbidden
     */

    public function __construct(\App\Models\Weather $model) {
        $this->model = $model;
        $this->rules = $model->rules;
    }

    public function index() {
        $rows = $this->model->with(['city'])
            ->latest()
            ->paginate(env('PAGE_LIMIT', 20));
        return \App\Http\Resources\WeatherResource::collection($rows);
    }

    public function show($id) {
        $row = $this->model->where('id', $id)->first();
        if (!$row)
            return abort(404);
        return new \App\Http\Resources\WeatherResource($row);
    }

    public function store() {
        $validator = Validator::make(request()->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 422);
        }
        $date = date('Y-m-d', strtotime(request('date')));
        $row = $this->model->where('date', $date)->where('city_id', request('city_id'))->first();
        if ($row) {
            return new \App\Http\Resources\WeatherResource($row);
        }
        else{
            \App\Jobs\CallWeatherAPI::dispatch($date, request('city_id'));
            $row = $this->model->where('date', $date)->where('city_id', request('city_id'))->first();
            if ($row) {
                return new \App\Http\Resources\WeatherResource($row);
            }
            else{
                return response()->json(['message' => 'Failed to get weather data from api'], 400);
            }
        }
        return response()->json(['message' => 'Failed to save'], 400);

    }
}
