<?php

use Illuminate\Database\Seeder;
use Overtrue\Pinyin\Pinyin;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            '管理','焊工','管工','办公室主任','钳工','仪表工','电工','司机','铆工','起重工','技术员','厨师','翻译','后勤','火焊','劳资','探伤','文控','修理'
        ];




        foreach($jobs as $job )
        {
            App\Position::create([
                'name' => $job,
                'pinyin'=>Pinyin::letter($job)
            ]);
        }

    }
}
