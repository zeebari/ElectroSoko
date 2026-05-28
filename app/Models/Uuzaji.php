<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uuzaji extends Model
{
    protected $table = 'mauzo';

    protected $fillable = [
        'nambari', 'mteja_id', 'aina_malipo', 'sarafu',
        'jumla', 'ilipwa', 'salio', 'hali', 'tarehe', 'maelezo',
    ];

    protected $casts = [
        'tarehe' => 'date',
        'jumla'  => 'float',
        'ilipwa' => 'float',
        'salio'  => 'float',
    ];

    public function mteja()
    {
        return $this->belongsTo(Mteja::class, 'mteja_id');
    }

    public function bidhaa()
    {
        return $this->hasMany(MauzoItem::class, 'uuzaji_id');
    }

    public function malipo()
    {
        return $this->hasMany(Malipo::class, 'uuzaji_id');
    }

    public function awamu()
    {
        return $this->hasOne(AwamuMpango::class, 'uuzaji_id');
    }
}
