<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    // Disable timestamps if you don't need created_at and updated_at
    public $timestamps = true;

    // Primary key for the table
    protected $primaryKey = 'id';

    // Set primary key as string if it's not auto-incrementing
    public $incrementing = false;
    protected $keyType = 'string';

    // Specify the table name explicitly
    protected $table = 'leads';

    // Attributes that are mass assignable

    protected $fillable = [
        'assignee',
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
    ];


    // Cast attributes to their proper data types
    protected $casts = [
        'created' => 'date',
        'last' => 'date',
        'upcoming' => 'date',
        'budget' => 'decimal:2',
        'follow' => 'boolean',
    ];

    // If 'assignee' refers to a User model, define the relationship here
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee');
    }
}
