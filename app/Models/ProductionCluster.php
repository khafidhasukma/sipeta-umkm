<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionCluster extends BaseModel
{
    use SoftDeletes;
    protected $fillable = [
        'nama_sentra',
        'jenis_komoditas',
        'polygon_json',
        'total_member',
    ];

    protected function casts(): array
    {
        return [
            'polygon_json' => 'array',
        ];
    }
}
