# 💡 Tips & Best Practices - SIPETA-UMKM

## 🎯 Laravel Best Practices

### 1. Model Conventions

```php
// ✅ GOOD - Extend BaseModel untuk UUID
class Produk extends BaseModel
{
    protected $fillable = ['nama', 'harga'];
}

// ❌ BAD - Extend Model langsung
class Produk extends Model
{
    use HasUuids; // Redundan jika sudah ada di BaseModel
}
```

### 2. Migration Best Practices

```php
// ✅ GOOD - UUID Primary Key
Schema::create('produks', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->foreignUuid('umkm_id')->constrained()->cascadeOnDelete();
    $table->string('nama');
    $table->timestamps();
});

// ❌ BAD - Integer Primary Key
Schema::create('produks', function (Blueprint $table) {
    $table->id(); // Jangan gunakan ini!
    $table->foreignId('umkm_id'); // Salah untuk UUID!
});
```

### 3. Relationships

```php
// ✅ GOOD - Type hints & return types
public function produks(): HasMany
{
    return $this->hasMany(Produk::class);
}

// ❌ BAD - No type hints
public function produks()
{
    return $this->hasMany(Produk::class);
}
```

### 4. Query Optimization

```php
// ✅ GOOD - Eager loading
$umkms = Umkm::with('produks', 'user')->get();

// ❌ BAD - N+1 problem
$umkms = Umkm::all();
foreach ($umkms as $umkm) {
    $umkm->produks; // Query per iteration!
}
```

---

## 🎨 Filament Best Practices

### 1. Resource Organization

```php
// ✅ GOOD - Organized imports
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

// Form schema
Forms\Components\TextInput::make('nama')
    ->required()
    ->maxLength(255);
```

### 2. Table Columns

```php
// ✅ GOOD - Descriptive & searchable
Tables\Columns\TextColumn::make('user.name')
    ->label('Pemilik')
    ->searchable()
    ->sortable();

// ❌ BAD - Tidak user-friendly
Tables\Columns\TextColumn::make('user_id');
```

### 3. Form Validation

```php
// ✅ GOOD - Inline validation
Forms\Components\TextInput::make('email')
    ->email()
    ->required()
    ->unique(ignoreRecord: true);

// ✅ BETTER - Custom Form Request
protected static function getFormValidationRules(): array
{
    return [
        'email' => ['required', 'email', 'unique:users,email'],
    ];
}
```

### 4. Scoped Queries (UMKM Panel)

```php
// ✅ GOOD - Filter by logged user
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('user_id', auth()->id());
}

// Atau global scope di model
protected static function booted(): void
{
    static::addGlobalScope('user', function (Builder $builder) {
        if (Filament::getCurrentPanel()->getId() === 'umkm') {
            $builder->where('user_id', auth()->id());
        }
    });
}
```

---

## 🧪 Testing Best Practices

### 1. Feature Tests (Pest)

```php
// ✅ GOOD - Descriptive test names
it('dapat membuat umkm baru dengan data valid', function () {
    $user = User::factory()->create();

    $data = [
        'user_id' => $user->id,
        'nama_umkm' => 'Warung Makan',
        'alamat' => 'Jl. Test No. 1',
    ];

    $umkm = Umkm::create($data);

    expect($umkm->id)->toBeString() // UUID
        ->and($umkm->nama_umkm)->toBe('Warung Makan');
});

// ❌ BAD - Generic test name
test('test umkm creation', function () {
    // ...
});
```

### 2. Factory Usage

```php
// ✅ GOOD - Use factories for test data
$umkms = Umkm::factory()->count(10)->create();

// ❌ BAD - Manual data creation
for ($i = 0; $i < 10; $i++) {
    Umkm::create([
        'nama_umkm' => 'UMKM ' . $i,
        // ...
    ]);
}
```

### 3. Assertions

```php
// ✅ GOOD - Specific assertions
expect($response->status())->toBe(200);
expect($response->json('data.id'))->toBeString();

// ❌ BAD - Generic assertions
assertTrue($response->status() === 200);
```

---

## 🔐 Security Best Practices

### 1. Mass Assignment Protection

```php
// ✅ GOOD - Explicit fillable
protected $fillable = [
    'nama_umkm',
    'alamat',
    'no_telp',
];

// ❌ BAD - Guarded empty (vulnerable!)
protected $guarded = [];
```

### 2. Authorization

```php
// ✅ GOOD - Use policies
public static function canViewAny(): bool
{
    return auth()->user()->can('view_any_umkm');
}

// ✅ GOOD - Check ownership
public static function canEdit(Model $record): bool
{
    return $record->user_id === auth()->id();
}
```

### 3. Input Validation

```php
// ✅ GOOD - Always validate
Forms\Components\TextInput::make('no_telp')
    ->tel()
    ->required()
    ->regex('/^[0-9]{10,13}$/');

// ❌ BAD - No validation
Forms\Components\TextInput::make('no_telp');
```

---

## 📦 Code Organization

### 1. Keep Controllers Thin

```php
// ✅ GOOD - Use Filament actions
Tables\Actions\EditAction::make();
Tables\Actions\DeleteAction::make();

// No need for manual controllers!
```

### 2. Use Form Requests (when needed)

```php
// ✅ GOOD - Separate validation logic
class StoreUmkmRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama_umkm' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ];
    }
}
```

### 3. Use Resource Collections

```php
// ✅ GOOD - API responses
return UmkmResource::collection($umkms);

// ❌ BAD - Raw data
return $umkms;
```

---

## 💾 Database Tips

### 1. Indexes

```php
// ✅ GOOD - Index frequently searched columns
$table->string('email')->unique();
$table->string('nama_umkm')->index();

// For UUID foreign keys
$table->foreignUuid('user_id')->index()->constrained();
```

### 2. Soft Deletes (Optional)

```php
// Model
use SoftDeletes;

// Migration
$table->softDeletes();

// Query
Umkm::withTrashed()->get();
Umkm::onlyTrashed()->get();
```

### 3. Timestamps

```php
// ✅ GOOD - Always use timestamps
$table->timestamps();

// Access
$umkm->created_at->diffForHumans(); // "2 hours ago"
```

---

## 🎨 UI/UX Tips (Filament)

### 1. Use Sections for Organization

```php
Forms\Components\Section::make('Informasi UMKM')
    ->schema([
        Forms\Components\TextInput::make('nama_umkm'),
        Forms\Components\Textarea::make('alamat'),
    ])
    ->columns(2);
```

### 2. Add Helper Text

```php
Forms\Components\TextInput::make('no_telp')
    ->helperText('Format: 08xxxxxxxxxx')
    ->placeholder('08123456789');
```

### 3. Use Icons

```php
protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
protected static ?string $navigationLabel = 'Produk';
protected static ?int $navigationSort = 1;
```

### 4. Custom Colors

```php
// In PanelProvider
->colors([
    'primary' => Color::Blue,
    'danger' => Color::Red,
    'success' => Color::Green,
])
```

---

## 🚀 Performance Tips

### 1. Pagination

```php
// ✅ GOOD - Paginate large datasets
Umkm::paginate(25);

// ❌ BAD - Get all (dapat membebani memory)
Umkm::all();
```

### 2. Select Specific Columns

```php
// ✅ GOOD - Only needed columns
Umkm::select('id', 'nama_umkm', 'created_at')->get();

// ❌ BAD - Select all
Umkm::all();
```

### 3. Cache Heavy Queries

```php
// ✅ GOOD - Cache for 1 hour
$umkmCount = Cache::remember('umkm_count', 3600, function () {
    return Umkm::count();
});

// ❌ BAD - Query every time
$umkmCount = Umkm::count();
```

---

## 🐛 Debugging Tips

### 1. Use dd() and dump()

```php
// Debug and die
dd($umkm);

// Debug and continue
dump($umkm);

// In Tinker
\App\Models\Umkm::first()->toArray();
```

### 2. Query Logging

```php
// Enable query log
\DB::enableQueryLog();

// Your queries here
Umkm::with('produks')->get();

// See queries
dd(\DB::getQueryLog());
```

### 3. Laravel Debugbar (Install jika perlu)

```bash
composer require barryvdh/laravel-debugbar --dev
```

### 4. Browser Console (Livewire)

```javascript
// In browser console
Livewire.all(); // See all Livewire components
```

---

## 📝 Git Commit Messages

### Convention

```bash
# Feature
git commit -m "Add: CRUD untuk modul Produk UMKM"

# Bug fix
git commit -m "Fix: Validasi no_telp tidak berfungsi"

# Refactor
git commit -m "Refactor: Optimize query produk dengan eager loading"

# Documentation
git commit -m "Docs: Update UUID reference guide"

# Style
git commit -m "Style: Format code dengan Laravel Pint"

# Test
git commit -m "Test: Add feature test untuk Umkm creation"
```

---

## ⚡ Quick Commands Shortcuts

### Create Full Resource

```bash
# Model + Migration + Factory + Seeder + Resource
php artisan make:model Produk -mfs && \
php artisan make:filament-resource Produk --generate && \
php artisan make:filament-resource Produk --panel=umkm --generate
```

### Reset Everything

```bash
# Nuclear option: Reset all
php artisan migrate:fresh --seed && \
php artisan optimize:clear && \
vendor/bin/pint
```

### Quick Test & Format

```bash
# Test + Format in one go
php artisan test && vendor/bin/pint
```

---

## 🎓 Learning Resources

### Official Documentation

-   Laravel 12: https://laravel.com/docs/12.x
-   FilamentPHP v4: https://filamentphp.com/docs/4.x
-   Tailwind CSS v4: https://tailwindcss.com/docs
-   Pest PHP: https://pestphp.com/docs

### UUID Best Practices

-   When to use UUID: Distributed systems, public IDs, security
-   When NOT to use UUID: Small projects, performance critical (debatable)
-   Storage: UUID as binary(16) lebih efisien (advanced)

---

## 🔍 Common Pitfalls to Avoid

### ❌ Jangan:

1. Menggunakan `id()` untuk primary key
2. Menggunakan `foreignId()` untuk FK ke UUID
3. Lupa menambahkan `use HasUuids` jika tidak extend BaseModel
4. Tidak menggunakan eager loading
5. Menaruh logic di controller (gunakan actions/models)
6. Commit code tanpa format (Pint)
7. Deploy tanpa run migration
8. Hard-code values
9. Skip validasi input
10. Expose sensitive data di API

### ✅ Lakukan:

1. Extend `BaseModel` untuk semua model
2. Gunakan UUID pattern yang konsisten
3. Tulis test untuk fitur baru
4. Format code dengan Pint
5. Eager load relationships
6. Gunakan Form Requests untuk validasi
7. Cache query yang berat
8. Use environment variables
9. Add indexes untuk performance
10. Document complex logic

---

## 🎯 Pro Tips

1. **Gunakan Tinker untuk testing**

    ```bash
    php artisan tinker
    >>> \App\Models\Umkm::factory()->create()
    ```

2. **Watch mode untuk tests**

    ```bash
    php artisan test --watch
    ```

3. **Filament quick create**

    ```bash
    # Buat resource dari model yang ada
    php artisan make:filament-resource Produk --generate
    ```

4. **Database quick check**

    ```bash
    php artisan db:show
    php artisan db:table users
    ```

5. **Route debugging**
    ```bash
    php artisan route:list --path=admin
    ```

---

**Remember**:

-   Code quality > Speed of development
-   Test first, deploy later
-   Document as you go
-   Consistency is key

**Happy Coding! 🚀**
