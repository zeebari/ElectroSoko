<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidhaa extends Model
{
    protected $table = 'bidhaa';

    protected $fillable = [
        'jina', 'aina', 'bei_ununuzi', 'bei_uuzaji', 'hisa', 'maelezo',
    ];

    public function mauzoItems()
    {
        return $this->hasMany(MauzoItem::class, 'bidhaa_id');
    }
}
