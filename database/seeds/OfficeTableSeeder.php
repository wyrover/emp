<?php

use Illuminate\Database\Seeder;
use Overtrue\Pinyin\Pinyin;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');
        $setting = [
            'delimiter' => '',
            'accent'    => false,
        ];
        foreach(range(1,5) as $item)
        {
            $name = $faker->city();
            App\Office::create([
                'name' => $name,
                'pinyin' =>Pinyin::letter($name,$setting)
            ]);
        }

    }
}
