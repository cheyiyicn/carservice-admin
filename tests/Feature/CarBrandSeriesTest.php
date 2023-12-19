<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class CarBrandSeriesTest extends TestCase
{
    /**
     * Test getting series of brand by brand_id.
     *
     * test ok.
     *
     * @return void
     */
    public function test_get_list_by_brand_id()
    {
        $response = $this->get('/');
        $brandId = 2;
        $data = DB::table('car_brand_series')
            ->select("series_id AS id", "series_name AS name")
            ->where("brand_id", "=", $brandId)
            ->where("business_status", "=", 1)
            ->limit(10)
            ->get()
            ->toArray();
        print_r($data);
        $response->assertStatus(200);
    }
}
