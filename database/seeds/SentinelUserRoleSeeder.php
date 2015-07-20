<?php

use Illuminate\Database\Seeder;

class SentinelUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->delete();

        $admin = Sentinel::findByCredentials([
            'login'=>'admin@admin.com'
        ]);
        $user = Sentinel::findByCredentials([
            'login'=>'user@user.com'
        ]);
        $editor = Sentinel::findByCredentials([
            'login'=>'editor@editor.com'
        ]);

        $role_admin = Sentinel::findRoleBySlug('admin');
        $role_editor = Sentinel::findRoleBySlug('editor');
        $role_user = Sentinel::findRoleBySlug('user');

        $role_admin->users()->attach($admin);
        $role_editor->users()->attach($editor);
        $role_user->users()->attach($user);

    }
}
