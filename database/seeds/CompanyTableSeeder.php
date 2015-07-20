<?php

use Illuminate\Database\Seeder;
use Overtrue\Pinyin\Pinyin;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        foreach(range(1,10) as $item)
        {
            $name = $faker->company();
            App\Company::create([
                'name' => $name,
                'pinyin'=>Pinyin::letter($name)
            ]);
        }

    }
}
