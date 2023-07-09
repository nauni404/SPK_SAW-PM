<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function smartphone()
    {
        return $this->belongsTo(Smartphone::class);
    }
}
