<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class publisher extends Model
{
    use SoftDeletes;

    protected $table = 'publishers';
    protected $dates = ['deleted_at'];
}
