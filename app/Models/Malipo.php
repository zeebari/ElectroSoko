<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Malipo extends Model
{
    protected $table = 'malipo';

    protected $fillable = [
        'uuzaji_id', 'kiasi', 'sarafu', 'tarehe', 'maelezo',
    ];

    protected $casts = [
        'tarehe' => 'date',
        'kiasi'  => 'float',
    ];

    public function uuzaji()
    {
        return $this->belongsTo(Uuzaji::class, 'uuzaji_id');
    }
}
