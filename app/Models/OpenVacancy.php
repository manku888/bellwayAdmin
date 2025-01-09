<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_no',
        'email',
        'service',
        'resume_link',
        'message',
    ];
}
