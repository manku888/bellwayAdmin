<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallRequest extends Model
{

    protected $table='callrequests';
    protected $fillable=[
        'name',
        'city',
        'phone_no',
        'date',
        'time',
        'message',

    ];
}
