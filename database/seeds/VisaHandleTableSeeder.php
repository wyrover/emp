<?php

use Illuminate\Database\Seeder;

class VisaHandleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            '签证延期','重新办理'
        ];



        foreach($items as $item)
        {
            App\VisaHandle::create([
                'method' => $item
            ]);
        }

    }
}
