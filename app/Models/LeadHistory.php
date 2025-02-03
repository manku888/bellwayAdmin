<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'lead_id',
        'assignee',
        'edit_by',
        'source',
        'service',
        'status',
        'budget',
        'full_name',
        'phone_number',
        'city',
        'email',
        'description',
        'last_follow_up_date',
        'follow_up_date',
        'follow_up',

    ];
}
