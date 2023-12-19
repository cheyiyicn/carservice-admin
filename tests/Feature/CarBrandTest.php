<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CarBrandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_brands()
    {
        $response = $this->get('/');

        $data = DB::table('car_brands')
            ->select("brand_id AS id", "brand_name AS name")
            ->where("business_status", "=", 1)
            ->limit(10)
            ->get()
            ->toArray();
        print_r($data);

        $response->assertStatus(200);
    }
}
