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
        return $this->hasMany(Synset::class,'synsetno', 'synsetno');
    }
    public function sample()
    {
        return $this->hasOne(Sample::class,'synsetno', 'synsetno');
    }

    public function semrel()
    {
        return $this->hasMany(Semrel::class,'synsetno1', 'synsetno');
    }

    public function word()
    {
        return $this->hasOne(Word::class,'wordno', 'wordno');
    }
}
