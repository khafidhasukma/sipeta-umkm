# UUID Reference - SIPETA-UMKM

## 🎯 Konsep Dasar UUID sebagai Primary Key

Semua tabel di sistem SIPETA-UMKM menggunakan UUID sebagai Primary Key untuk:

-   Keamanan (ID tidak sequential/predictable)
-   Skalabilitas (generate ID tanpa database)
-   Konsistensi global

---

## 📝 Template & Cheat Sheet

### 1. Membuat Model Baru

```bash
php artisan make:model NamaModel -m
```

**File Model** (`app/Models/NamaModel.php`):

```php
<?php

namespace App\Models;

class NamaModel extends BaseModel
{
    protected $fillable = [
        'nama_field',
        'field_lainnya',
    ];

    // Relasi dan method lainnya
}
```

**✅ BENAR** - Extend `BaseModel` (UUID sudah otomatis)  
**❌ SALAH** - Extend `Model` langsung

---

### 2. Migration Template

**Migration File** (`database/migrations/xxxx_create_nama_models_table.php`):

#### Tabel Standar dengan UUID

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nama_models', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Field-field tabel
            $table->string('nama');
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nama_models');
    }
};
```

#### Tabel dengan Foreign Key UUID

```php
Schema::create('produk_umkm', function (Blueprint $table) {
    $table->uuid('id')->primary();

    // Foreign key ke tabel users (yang menggunakan UUID)
    $table->foreignUuid('user_id')
          ->constrained('users')
          ->cascadeOnDelete();

    // Foreign key ke tabel kategori (yang menggunakan UUID)
    $table->foreignUuid('kategori_id')
          ->constrained('kategoris')
          ->cascadeOnDelete();

    $table->string('nama_produk');
    $table->decimal('harga', 12, 2);

    $table->timestamps();
});
```

---

### 3. Factory Template

**Factory File** (`database/factories/NamaModelFactory.php`):

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NamaModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => Str::uuid(), // Generate UUID untuk testing
            'nama' => fake()->name(),
            'deskripsi' => fake()->paragraph(),
        ];
    }
}
```

**⚠️ NOTE**: Untuk factory, UUID akan auto-generate jika menggunakan `BaseModel`, tapi bisa di-override jika perlu.

---

### 4. Seeder Template

**Seeder File** (`database/seeders/NamaModelSeeder.php`):

```php
<?php

namespace Database\Seeders;

use App\Models\NamaModel;
use Illuminate\Database\Seeder;

class NamaModelSeeder extends Seeder
{
    public function run(): void
    {
        NamaModel::create([
            'nama' => 'Contoh Data',
            'deskripsi' => 'Deskripsi contoh',
        ]);

        // Atau menggunakan factory
        NamaModel::factory()->count(10)->create();
    }
}
```

---

### 5. Relasi Eloquent dengan UUID

#### One to Many

```php
// Model User
public function produk()
{
    return $this->hasMany(Produk::class);
}

// Model Produk
public function user()
{
    return $this->belongsTo(User::class);
}
```

#### Many to Many (Pivot Table)

```php
// Migration pivot table
Schema::create('umkm_kategori', function (Blueprint $table) {
    $table->foreignUuid('umkm_id')
          ->constrained('umkms')
          ->cascadeOnDelete();

    $table->foreignUuid('kategori_id')
          ->constrained('kategoris')
          ->cascadeOnDelete();

    $table->timestamps();

    $table->primary(['umkm_id', 'kategori_id']);
});

// Model Umkm
public function kategoris()
{
    return $this->belongsToMany(Kategori::class, 'umkm_kategori');
}
```

---

### 6. Routing dengan UUID

**Route Definition**:

```php
// routes/web.php
Route::get('/produk/{produk}', [ProdukController::class, 'show']);
```

**Controller**:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class ProdukController extends Controller
{
    public function show(Produk $produk)
    {
        // Model binding otomatis bekerja dengan UUID
        return view('produk.show', compact('produk'));
    }
}
```

**URL akan terlihat seperti**:

```
/produk/9b8e3a1c-4567-4d89-b012-abcdef123456
```

---

### 7. Filament Resource dengan UUID

**Resource File** (`app/Filament/Resources/ProdukResource.php`):

```php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                Forms\Components\TextInput::make('nama_produk')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
```

**✅ Filament otomatis handle UUID dengan sempurna!**

---

### 8. Testing dengan UUID

**Feature Test**:

```php
<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('dapat membuat produk baru', function () {
    $user = User::factory()->create();

    $produk = Produk::create([
        'user_id' => $user->id, // UUID otomatis
        'nama_produk' => 'Produk Test',
        'harga' => 10000,
    ]);

    expect($produk->id)->toBeString(); // UUID adalah string
    expect($produk->user_id)->toBe($user->id);

    $this->assertDatabaseHas('produk_umkm', [
        'nama_produk' => 'Produk Test',
    ]);
});
```

---

## ⚠️ Hal yang Perlu Diingat

### ✅ DO (Lakukan):

1. Selalu extend `BaseModel` untuk model baru
2. Gunakan `uuid('id')->primary()` di migration
3. Gunakan `foreignUuid('column')` untuk foreign key
4. UUID otomatis di-generate, tidak perlu manual
5. Route model binding bekerja otomatis

### ❌ DON'T (Jangan):

1. Jangan gunakan `$table->id()` (auto-increment)
2. Jangan gunakan `foreignId()` untuk FK UUID
3. Jangan manual set UUID kecuali testing
4. Jangan expect integer ID dalam validasi
5. Jangan gunakan `increments()` atau `bigIncrements()`

---

## 🔍 Troubleshooting

### Error: "Column 'id' cannot be null"

**Solusi**: Pastikan model extend `BaseModel` atau memiliki trait `HasUuids`

### Error: "Foreign key constraint fails"

**Solusi**: Pastikan menggunakan `foreignUuid()` bukan `foreignId()`

### Error: "Invalid UUID format"

**Solusi**: Validasi input UUID dengan rule `uuid`

```php
'user_id' => ['required', 'uuid', 'exists:users,id'],
```

---

## 📚 Referensi

-   [Laravel UUID Documentation](https://laravel.com/docs/eloquent#uuid-and-ulid-keys)
-   [FilamentPHP Documentation](https://filamentphp.com/docs)
-   [UUID Best Practices](https://www.percona.com/blog/store-uuid-optimized-way/)

---

**Dibuat untuk**: SIPETA-UMKM  
**Stack**: Laravel 12 + FilamentPHP v4 + Tailwind v4
