<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class book extends Model
{
    use SoftDeletes;
    protected $table = 'books';
    protected $dates = ['deleted_at'];

    public function publisher()
    {
        return $this->belongsTo(publisher::class);
    }
}
