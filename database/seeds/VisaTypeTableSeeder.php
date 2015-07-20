<?php

use Illuminate\Database\Seeder;

class VisaTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            '江布尔州劳务','阿拉木图120人劳务','南哈州劳务','商务'
        ];



        foreach($items as $item)
        {
            App\VisaType::create([
                'type' => $item
            ]);
        }

    }
}
