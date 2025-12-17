<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Base Model dengan UUID sebagai Primary Key secara default.
 *
 * Semua model di aplikasi SIPETA-UMKM harus extend BaseModel ini
 * untuk memastikan konsistensi penggunaan UUID sebagai Primary Key.
 */
abstract class BaseModel extends Model
{
    use HasUuids;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';
}
