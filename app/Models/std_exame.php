<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class std_exame extends Model
{
    use HasFactory;
    protected $fillable = [
        'score',
        'ques'
    ];
}
