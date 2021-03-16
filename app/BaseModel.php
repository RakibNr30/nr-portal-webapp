<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	private $format = 'Y-m-d';

    public function getCreatedAtAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getUpdatedAtAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getStartDateAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getEndDateAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getDisplayDateAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getDobAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }
}
