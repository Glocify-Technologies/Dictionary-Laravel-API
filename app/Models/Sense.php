<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sense extends Model
{
    use HasFactory;
    protected $table = 'sense';
    public $timestamps = false;

    public function synset()
    {
        return $this->hasOne(Synset::class,'synsetno', 'synsetno');
    }
}
