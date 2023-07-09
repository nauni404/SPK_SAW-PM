<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemetaanGap extends Model
{
    use HasFactory;

    protected $table = 'pemetaan_gap';

    protected $guarded = ['id'];
}
