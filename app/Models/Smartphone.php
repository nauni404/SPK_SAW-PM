<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function weights()
    {
        return $this->hasMany(Weight::class);
    }

    public function standards()
    {
        return $this->hasMany(Standard::class);
    }
}
