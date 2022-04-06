<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synset extends Model
{
    use HasFactory;
    protected $table = 'synset';
    public $timestamps = false;

    public function lexname()
    {
        return $this->hasOne(Lexname::class,'lexno', 'lexno');
    }
}
