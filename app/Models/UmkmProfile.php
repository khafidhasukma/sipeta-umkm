<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UmkmProfile extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'nama_usaha',
        'alamat_lengkap',
        'kecamatan',
        'kelurahan',
        'latitude',
        'longitude',
        'omzet_bulanan',
        'jumlah_tenaga_kerja',
        'is_verified',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'omzet_bulanan' => 'decimal:2',
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productionTools(): HasMany
    {
        return $this->hasMany(ProductionTool::class);
    }

    public function rawMaterials(): HasMany
    {
        return $this->hasMany(RawMaterial::class);
    }
}
