<?php

namespace Tests\Feature\Api\V2;

use Tests\TestCase;

class ApiWeatherTest extends TestCase {
    public function test_index() {
        dump(get_class($this) . ' ' . 'index');
        $this->get('api/weather')
            ->assertStatus(200);
    }

    public function test_view() {
        dump(get_class($this) . ' ' . 'view');
        /////////////////////////////////////////
        $record = \App\Models\Weather::factory()->create();
        $this->get('api/weather/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }

    public function test_post_create() {
        dump(get_class($this) . ' ' . 'create');
        ///////////////////////////////
        $city=\App\Models\City::first();
        $this->post('api/weather', ['date'=>date('Y-m-d'),'city_id'=>$city->id])
            ->assertStatus(200);
    }
}
