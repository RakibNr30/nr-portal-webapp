<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $guarded = [];
    
    protected $fillable = [
        'from',
        'to',
        'message_from_type',
        'message_to_type',
        'message',
        'read',
    ];

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    private $format = 'h:i:s - M d, Y';

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }
}
