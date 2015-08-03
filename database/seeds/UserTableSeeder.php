<?php

use App\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        生成角色
        $admin = Role::create([
            'name'=>'Admin',
            'slug'=>'admin',
            'description'=>'拥有最高权限,可以管理其他用户',
            'level' =>9
        ]);

        $editor = Role::create([
            'name'=>'Editor',
            'slug'=>'editor',
            'description'=>'可进行内容信息的操作维护',
            'level'=>2
        ]);

        $user = Role::create([
            'name'=>'User',
            'slug'=>'user',
            'description'=>'可以检索查看内容信息',
            'level'=>1
        ]);

//        生成用户

        $user1 = new User();
        $user1->name = 'Partoo';
        $user1->email = 'partoo@163.com';
        $user1->password = Hash::make('admin');
        $user1->save();

        $user2 = new User();
        $user2->name = 'editor';
        $user2->email = 'editor@editor.com';
        $user2->password = Hash::make('editor');
        $user2->save();

        $user3 = new User();
        $user3->name = 'user';
        $user3->email = 'user@user.com';
        $user3->password = Hash::make('user');
        $user3->save();

//        生成权限

        $edit = Permission::create([
            'name' => 'Edit Contents',
            'slug' => 'Edit.Contents',
            'description' => '创建修改删除内容信息'
        ]);

        $edit_user = Permission::create([
            'name' => 'Edit Users',
            'slug' => 'Edit.Users',
            'description' => '创建修改删除用户信息'
        ]);


//        分配权限


        $user1->attachRole($admin);
        $user2->attachRole($editor);
        $user3->attachRole($user);



        $admin->attachPermission($edit);
        $admin->attachPermission($edit_user);
        $editor->attachPermission($edit);


    }
}
