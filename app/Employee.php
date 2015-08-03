<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = ['id'];

//    protected $hidden = ['id','position_id','company_id','office_id','visa_type_id','visa_handle_id'];

    public function company()
    {
       return $this->belongsTo('App\Company')->select(['id','name']);
    }


    public function office()
    {
        return $this->belongsTo('App\Office')->select(['id','name']);
    }


    public function visaHandle()
    {
        return $this->belongsTo('App\VisaHandle')->select(['id','method']);
    }


    public function visaType()
    {
        return $this->belongsTo('App\VisaType')->select(['id','type']);
    }

    public function position()
    {
        return $this->belongsTo('App\Position')->select(['id','name']);
    }

    public function getReachedAtAttribute()
    {
        return  date_format(date_create($this->attributes['reached_at']),'Y-m-d');
    }

    public function setReachedAtAttribute($date)
    {
        $this->attributes['reached_at'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    public function getPassportDateAttribute()
    {
        return  date_format(date_create($this->attributes['passport_date']),'Y-m-d');
    }

    public function setPassportDateAttribute($date)
    {
        $this->attributes['passport_date'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    public function getPassportDeadlineAttribute()
    {
        return  date_format(date_create($this->attributes['passport_deadline']),'Y-m-d');
    }

    public function setPassportDeadlineAttribute($date)
    {
        $this->attributes['passport_deadline'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    public function getVisaDeadlineAttribute()
    {
        return  date_format(date_create($this->attributes['visa_deadline']),'Y-m-d');
    }

    public function setVisaDeadlineAttribute($date)
    {
        $this->attributes['visa_deadline'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    public function getLandDeadlineAttribute()
    {
        return  date_format(date_create($this->attributes['land_deadline']),'Y-m-d');
    }

    public function setLandDeadlineAttribute($date)
    {
        $this->attributes['land_deadline'] = Carbon::createFromFormat('Y-m-d',$date);
    }


}
