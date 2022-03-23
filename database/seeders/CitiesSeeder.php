<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder {
    /*     * ,
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        if (\Schema::hasTable('cities')) {
            \DB::table('cities')->delete();
            \DB::statement("ALTER TABLE `cities` AUTO_INCREMENT = 1");
            $json = json_decode(@file_get_contents(storage_path() . '/cities.json'));
            if($json->cities){
                $rows=[];
                foreach ($json->cities as $city){
                    $row=[
                        'id'=>$city->id,
                        'name'=>$city->name,
                        'country'=>$city->country,
                        'lat'=>$city->coord->lat,
                        'lon'=>$city->coord->lon,
                    ];
                    $rows[]=$row;
                }
                \App\Models\City::insert($rows);
            }
        }
    }
}
