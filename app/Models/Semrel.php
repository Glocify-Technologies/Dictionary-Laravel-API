<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semrel extends Model
{
    use HasFactory;
    protected $table = 'semrel';
    public $timestamps = false;

    public function sensesWord()
    {
        return $this->hasMany(Sense::class,'synsetno', 'synsetno2');
    }

    public function reltype()
    {
        return $this->hasOne(Reltype::class,'reltypeno', 'reltypeno');
    }
}
