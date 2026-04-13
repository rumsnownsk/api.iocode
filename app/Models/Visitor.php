<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $table = 'visitors';
    public $fillable = [
        'ip_address',
        'user_agent',
        'geolocation',
        'city',
        'provider',
        'referrer',
        'page_url',
        'page_title',
        'screen_resolution',
        'language',
        'timezone',
        'device_type',
        'browser',
        'os',
        'session_id',
        'visited_at'
    ];
}
