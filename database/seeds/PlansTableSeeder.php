<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('plans')->insertGetId(
            [
                'name' => "Ботан",
                'description' => "Яблоко и кефир",
                'price' => 100
            ]
        );
        DB::table('delivery_days')->insert([
            [
                'day_of_week' => 1,
                'plan_id' => $id,
            ],
            [
                'day_of_week' => 3,
                'plan_id' => $id,
            ],
        ]);
        $id = DB::table('plans')->insertGetId(
            [
                'name' => "ЗОЖ",
                'description' => "Безглютеновая булочка, варенье без сахара и ГМО",
                'price' => 1000
            ]
        );
        DB::table('delivery_days')->insert([
            [
                'day_of_week' => 2,
                'plan_id' => $id,
            ],
            [
                'day_of_week' => 4,
                'plan_id' => $id,
            ],
        ]);
        $id = DB::table('plans')->insertGetId(
            [
                'name' => "Бабушка Бетмен",
                'description' => "Доширак и маска супергероя",
                'price' => 1500
            ]
        );
        DB::table('delivery_days')->insert([
            [
                'day_of_week' => 3,
                'plan_id' => $id,
            ],
            [
                'day_of_week' => 5,
                'plan_id' => $id,
            ],
        ]);
    }
}
