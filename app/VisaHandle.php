<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaHandle extends Model
{
    protected  $fillable = ['method'];

    public function employee(){
        return $this->hasMany('App\Employee');
    }
}
