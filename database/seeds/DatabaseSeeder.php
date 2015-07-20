<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

      // $this->call('UserTableSeeder');
//        $this->call('CompanyTableSeeder');
//       $this->call('OfficeTableSeeder');
//       $this->call('PositionTableSeeder');
//       $this->call('VisaHandleTableSeeder');
//       $this->call('VisaTypeTableSeeder');
//        $this->call('EmployeeTableSeeder');
//        $this->call('SentinelUserSeeder');
//        $this->call('SentinelRoleSeeder');
        $this->call('SentinelUserRoleSeeder');

        Model::reguard();
    }
}
