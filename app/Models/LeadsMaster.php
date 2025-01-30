<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsMaster extends Model
{
    use HasFactory;

    protected $table='leads_master';
    protected $fillable = ['type', 'name', 'bg_color', 'status'];
}

