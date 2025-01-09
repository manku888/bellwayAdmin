<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hiring extends Model
{
    protected $table = 'hirings';
    use HasFactory;

    protected $fillable = ['positions', 'experience'];
}
