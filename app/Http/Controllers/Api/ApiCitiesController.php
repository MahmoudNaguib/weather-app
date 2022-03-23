<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Validator;

class ApiCitiesController extends Controller {
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

    public function __construct(\App\Models\City $model) {
        $this->model = $model;
    }

    public function index() {
        $rows = $this->model
            ->latest()
            ->paginate(env('PAGE_LIMIT', 20));
        return \App\Http\Resources\CityResource::collection($rows);
    }

    public function show($id) {
        $row = $this->model->where('id', $id)->first();
        if (!$row)
            return abort(404);
        return new \App\Http\Resources\CityResource($row);
    }

}
