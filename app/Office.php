<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected  $fillable = ['name'];

    public function employee(){
        return $this->hasMany('App\Employee');
    }
}
