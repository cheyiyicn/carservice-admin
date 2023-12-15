<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarBrandSeeder extends Seeder
{
    private $records = [
        ["id" => 1, "car_company_id" => 0, "title" => "奥迪", "english_title" => "", "description" => "", "short_title" => "", "type" => ""],
        ["id" => 2, "car_company_id" => 0, "title" => "宝马", "english_title" => "", "description" => "", "short_title" => "", "type" => ""],
        ["id" => 3, "car_company_id" => 0, "title" => "奔驰", "english_title" => "", "description" => "", "short_title" => "", "type" => ""],
        ["id" => 4, "car_company_id" => 0, "title" => "长安", "english_title" => "", "description" => "", "short_title" => "", "type" => ""],
        ["id" => 5, "car_company_id" => 0, "title" => "大众", "english_title" => "", "description" => "", "short_title" => "", "type" => ""],
        ["id" => 8, "car_company_id" => 0, "title" => "法拉利", "english_title" => "", "description" => "", "short_title" => "", "type" => ""],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("car_brands")->insert($this->records);
    }
}
