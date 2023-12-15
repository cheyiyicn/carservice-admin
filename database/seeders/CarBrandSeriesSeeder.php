<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarBrandSeriesSeeder extends Seeder
{
    private $records = [
        ["id" => 1, "car_brand_id" => 5, "title" => "朗逸", "english_title" => "", "dealer_price" => "7.59-12.39万", "offical_price" => "9.39-15.19万"],
        ["id" => 2, "car_brand_id" => 5, "title" => "帕萨特", "english_title" => "", "dealer_price" => "14.59-21.69万", "offical_price" => "18.19-25.29万"],
        ["id" => 3, "car_brand_id" => 5, "title" => "速腾", "english_title" => "", "dealer_price" => "8.99-13.49万", "offical_price" => "12.79-17.29万"],
        ["id" => 4, "car_brand_id" => 5, "title" => "迈腾", "english_title" => "", "dealer_price" => "14.99-21.69万", "offical_price" => "18.69-25.39万"],
        ["id" => 5, "car_brand_id" => 5, "title" => "途观L", "english_title" => "", "dealer_price" => "暂无报价", "offical_price" => "暂无报价"],
        ["id" => 6, "car_brand_id" => 5, "title" => "高尔夫", "english_title" => "", "dealer_price" => "暂无报价", "offical_price" => "暂无报价"],
        ["id" => 7, "car_brand_id" => 5, "title" => "蔚揽", "english_title" => "", "dealer_price" => "暂无报价", "offical_price" => "暂无报价"],
        ["id" => 8, "car_brand_id" => 5, "title" => "探岳GTE", "english_title" => "", "dealer_price" => "暂无报价", "offical_price" => "暂无报价"],
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("car_brand_series")->insert($this->records);
    }
}
