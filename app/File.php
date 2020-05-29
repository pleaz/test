<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class File extends Model
{
    protected $fillable = [
        'name', 'src'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    public function getIdAttribute($value)
    {
        return Hashids::encode($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
