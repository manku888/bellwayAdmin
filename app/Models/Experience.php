<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'current_location',
        'current_ctc',
        'notice_period',
        'total_experience',
        'resume_link',
        'selected_role',
    ];
}
