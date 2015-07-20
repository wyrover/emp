<?php

use App\Company;
use App\Office;
use App\Position;
use App\VisaHandle;
use App\VisaType;
use Illuminate\Database\Seeder;
use Overtrue\Pinyin\Pinyin;

class EmployeeTableSeeder extends Seeder
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

        foreach(range(1,100) as $item)
        {
            $name = $faker->name();
            App\Employee::create([
                'name' =>$name,
                'position_id'=>rand(1,count(Position::all()->toArray())),
                'company_id'=>rand(1,count(Company::all()->toArray())),
                'office_id'=>rand(1,count(Office::all()->toArray())),
                'passport'=>$faker->swiftBicNumber(),
                'passport_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
                'passport_deadline'=>$faker->date($format = 'Y-m-d', $max = 'now') ,
                'visa_deadline'=>$faker->date($format = 'Y-m-d', $max = 'now') ,
                'land_deadline'=>$faker->date($format = 'Y-m-d', $max = 'now') ,
                'visa_handle_id'=>rand(1,count(VisaHandle::all()->toArray())),
                'visa_type_id'=>rand(1,count(VisaType::all()->toArray())),
                'reached_at'=>$faker->date($format = 'Y-m-d', $max = 'now') ,
                'pinyin'=>Pinyin::letter($name,$setting)

            ]);
        }
    }
}
