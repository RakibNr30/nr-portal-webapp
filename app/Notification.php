<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'project_id',
        'notification_to',
        'notification_from',
        'notification_to_type',
        'notification_from_type',
        'message',
        'status',
    ];
}
