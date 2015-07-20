<?php

use Illuminate\Database\Seeder;

class SentinelRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => '管理员',
            'slug' => 'admin',
            'permissions'=>[
                'admin' => true,
                'edit' => true,
                'view' => true
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => '编辑',
            'slug' => 'editor',
            'permissions'=>[
                'admin' => false,
                'edit' => true,
                'view' => true
            ]
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => '普通用户',
            'slug' => 'user',
            'permissions'=>[
                'admin' => false,
                'edit' => false,
                'view' => true
            ]
        ]);
    }
}
