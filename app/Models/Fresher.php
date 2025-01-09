<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fresher extends Model
{
   protected $table ='freshers';


   protected $fillable=
    [
        'name',
        'email',
        'phone_no',
        'resume',
        'cover_letter',

    ];
}
