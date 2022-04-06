<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reltype extends Model
{
    use HasFactory;
    protected $table = 'reltype';
    public $timestamps = false;
}
