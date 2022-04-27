<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lexrel extends Model
{
    use HasFactory;
    protected $table = 'lexrel';
    public $timestamps = false;

    public function word()
    {
        return $this->hasOne(Word::class,'wordno', 'wordno2');
    }
    public function reltype()
    {
        return $this->hasOne(Reltype::class,'reltypeno', 'reltypeno');
    }
}
