<?php

use Illuminate\Database\Seeder;

class AdvertisingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertisings')->insert(
            [
                ['own' => 'doc', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'main_1'],
                ['own' => 'doc', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'main_2'],
                ['own' => 'doc', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'main_3'],
                ['own' => 'doc', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'sidebar'],
                ['own' => 'doc', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'sidebar_2'],
                ['own' => 'doc', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'footer'],
                ['own' => 'patient', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'main_1'],
                ['own' => 'patient', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'main_2'],
                ['own' => 'patient', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'sidebar'],
                ['own' => 'patient', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'sidebar_2'],
                ['own' => 'patient', 'text' => 'reklama', 'text2' => 'reklama', 'text3' => 'reklama', 'text4' => 'reklama', 'text5' => 'reklama', 'placement' => 'footer'],
            ]
        );
    }
}
