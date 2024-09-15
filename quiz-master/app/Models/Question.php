<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question'
    ];

    public function options()
    {
        //has three options
        return $this->hasMany(Option::class);
    }
}
