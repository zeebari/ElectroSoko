<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwamuMpango extends Model
{
    protected $table = 'awamu_mipango';

    protected $fillable = [
        'uuzaji_id', 'idadi_awamu', 'kiasi_kila_awamu', 'tarehe_mwanzo', 'siku_baina',
    ];

    protected $casts = [
        'tarehe_mwanzo'    => 'date',
        'kiasi_kila_awamu' => 'float',
    ];

    public function uuzaji()
    {
        return $this->belongsTo(Uuzaji::class, 'uuzaji_id');
    }
}
