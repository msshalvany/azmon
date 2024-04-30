<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exame extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'count',
        'name',
        'password',
        'rand_choice',
        'rand_que',
        'date',
        'time',
        'deadline',
        'type',

    ];
    protected $casts = [
        'rand_choice' => 'boolean',
        'rand_que' => 'boolean',
    ];

}
