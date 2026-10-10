<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'tema_agent',
        'api_key_secure',
        'user_id',
    ];
}
