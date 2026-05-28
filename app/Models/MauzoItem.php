<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MauzoItem extends Model
{
    protected $table = 'mauzo_bidhaa';

    protected $fillable = [
        'uuzaji_id', 'bidhaa_id', 'idadi', 'bei', 'jumla',
    ];

    public function bidhaa()
    {
        return $this->belongsTo(Bidhaa::class, 'bidhaa_id');
    }

    public function uuzaji()
    {
        return $this->belongsTo(Uuzaji::class, 'uuzaji_id');
    }
}
