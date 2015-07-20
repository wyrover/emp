<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('position_id')->unsigned()->comment('岗位id');
            $table->integer('company_id')->unsigned()->comment('所在公司id');
            $table->integer('office_id')->unsigned()->comment('所在地id');
            $table->string('passport')->comment('护照号');
            $table->timestamp('passport_date')->comment('发照日期');
            $table->timestamp('passport_deadline')->comment('护照有效期');
            $table->integer('visa_type_id')->unsigned()->comment('签证类型id');
            $table->timestamp('visa_deadline')->comment('签证期限');
            $table->timestamp('land_deadline')->comment('落地签期限');
            $table->integer('visa_handle_id')->unsigned()->comment('办理预案id');
            $table->timestamp('reached_at')->comment('到赴工地日期');
            $table->string('pinyin');
            $table->text('memo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
