<?php

use Illuminate\Database\Seeder;

class SentinelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        Sentinel::create([
            'email'    => 'admin@admin.com',
            'username' => 'admin',
            'password' => 'Admin',
        ]);

        Sentinel::create([
            'email'    => 'user@user.com',
            'username' => 'user',
            'password' => 'User',
        ]);

        Sentinel::create([
            'email'    => 'editor@editor.com',
            'username' => 'editor',
            'password' => 'Editor',
        ]);
    }
}
