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
    public function questions()
    {
        return $this->hasMany(question::class,'exame_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
