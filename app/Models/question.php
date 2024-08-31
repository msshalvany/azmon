<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exame_id',
        'type',
        'text',
        'image',
        'chose1',
        'chose2',
        'chose3',
        'chose4',
        'chose1img',
        'chose2img',
        'chose3img',
        'chose4img',
        'answer',
        'fasl',
        'level',
        'term'
    ];
    public function exame()
    {
         return $this->belongsTo(exame::class,'exame_id');
    }
}
