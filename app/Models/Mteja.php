<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mteja extends Model
{
    protected $table = 'wateja';

    protected $fillable = [
        'jina', 'simu', 'anwani', 'sarafu_pendwa', 'maelezo',
    ];

    public function mauzo()
    {
        return $this->hasMany(Uuzaji::class, 'mteja_id');
    }

    public function jumla_madeni(): float
    {
        return (float) $this->mauzo()
            ->whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi')
            ->sum('salio');
    }
}
