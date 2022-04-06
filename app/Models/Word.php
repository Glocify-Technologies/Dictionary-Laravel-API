<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;
    protected $table = 'word';
    public $timestamps = false;

    public function senses()
    {
        return $this->hasMany(Sense::class,'wordno', 'wordno');
    }
}
