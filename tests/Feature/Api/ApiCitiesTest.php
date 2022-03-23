<?php

namespace Tests\Feature\Api\V2;

use Tests\TestCase;

class ApiCitiesTest extends TestCase {
    public function test_index() {
        dump(get_class($this) . ' ' . 'index');
        $this->get('api/cities')
            ->assertStatus(200);
    }

    public function test_view() {
        dump(get_class($this) . ' ' . 'view');
        /////////////////////////////////////////
        $record = \App\Models\City::factory()->create();
        $this->get('api/cities/' . $record->id)
            ->assertStatus(200);
        $record->forceDelete();
    }
}
