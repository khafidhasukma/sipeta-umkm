<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionTool extends BaseModel
{
    protected $fillable = [
        'umkm_profile_id',
        'nama_alat',
        'jenis',
        'kapasitas',
        'kondisi',
        'status_kepemilikan',
    ];

    public function umkmProfile(): BelongsTo
    {
        return $this->belongsTo(UmkmProfile::class);
    }
}
