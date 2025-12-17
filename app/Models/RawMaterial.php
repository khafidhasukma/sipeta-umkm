<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RawMaterial extends BaseModel
{
    protected $fillable = [
        'umkm_profile_id',
        'nama_bahan',
        'kebutuhan_per_bulan',
        'satuan',
        'asal_supplier',
    ];

    protected function casts(): array
    {
        return [
            'kebutuhan_per_bulan' => 'decimal:2',
        ];
    }

    public function umkmProfile(): BelongsTo
    {
        return $this->belongsTo(UmkmProfile::class);
    }
}
