<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaType extends Model
{
    protected  $fillable = ['type'];


    public function employee(){
        return $this->hasMany('App\Employee');
    }
}
