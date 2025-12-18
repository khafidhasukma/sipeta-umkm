<?php

namespace Database\Factories;

use App\Models\UmkmProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UmkmProfileFactory extends Factory
{
    protected $model = UmkmProfile::class;

    // Kecamatan dan Kelurahan di Kota Semarang dengan koordinat realistis
    private static $locations = [
        'Semarang Tengah' => [
            ['kelurahan' => 'Kauman', 'lat' => -6.9834, 'lng' => 110.4203],
            ['kelurahan' => 'Pekunden', 'lat' => -6.9812, 'lng' => 110.4165],
            ['kelurahan' => 'Brumbungan', 'lat' => -6.9796, 'lng' => 110.4189],
            ['kelurahan' => 'Sekayu', 'lat' => -6.9758, 'lng' => 110.4142],
            ['kelurahan' => 'Miroto', 'lat' => -6.9823, 'lng' => 110.4231],
        ],
        'Semarang Utara' => [
            ['kelurahan' => 'Bandarharjo', 'lat' => -6.9532, 'lng' => 110.4198],
            ['kelurahan' => 'Tanjung Mas', 'lat' => -6.9475, 'lng' => 110.4287],
            ['kelurahan' => 'Purwosari', 'lat' => -6.9689, 'lng' => 110.4276],
            ['kelurahan' => 'Panggung Lor', 'lat' => -6.9612, 'lng' => 110.4234],
            ['kelurahan' => 'Dadapsari', 'lat' => -6.9587, 'lng' => 110.4156],
        ],
        'Semarang Selatan' => [
            ['kelurahan' => 'Lamper Kidul', 'lat' => -7.0123, 'lng' => 110.4387],
            ['kelurahan' => 'Lamper Lor', 'lat' => -7.0089, 'lng' => 110.4412],
            ['kelurahan' => 'Mugassari', 'lat' => -7.0145, 'lng' => 110.4298],
            ['kelurahan' => 'Randusari', 'lat' => -7.0201, 'lng' => 110.4356],
            ['kelurahan' => 'Pleburan', 'lat' => -7.0067, 'lng' => 110.4289],
        ],
        'Semarang Timur' => [
            ['kelurahan' => 'Mlatiharjo', 'lat' => -6.9923, 'lng' => 110.4523],
            ['kelurahan' => 'Rejomulyo', 'lat' => -6.9856, 'lng' => 110.4589],
            ['kelurahan' => 'Bugangan', 'lat' => -6.9789, 'lng' => 110.4612],
            ['kelurahan' => 'Kemijen', 'lat' => -6.9834, 'lng' => 110.4678],
            ['kelurahan' => 'Sarirejo', 'lat' => -6.9912, 'lng' => 110.4701],
        ],
        'Semarang Barat' => [
            ['kelurahan' => 'Ngemplak Simongan', 'lat' => -6.9823, 'lng' => 110.3912],
            ['kelurahan' => 'Manyaran', 'lat' => -6.9756, 'lng' => 110.3845],
            ['kelurahan' => 'Krobokan', 'lat' => -6.9889, 'lng' => 110.3987],
            ['kelurahan' => 'Kalibanteng Kidul', 'lat' => -6.9934, 'lng' => 110.3823],
            ['kelurahan' => 'Bongsari', 'lat' => -6.9867, 'lng' => 110.3901],
        ],
        'Tembalang' => [
            ['kelurahan' => 'Tembalang', 'lat' => -7.0512, 'lng' => 110.4389],
            ['kelurahan' => 'Bulusan', 'lat' => -7.0456, 'lng' => 110.4512],
            ['kelurahan' => 'Sendangmulyo', 'lat' => -7.0589, 'lng' => 110.4456],
            ['kelurahan' => 'Meteseh', 'lat' => -7.0623, 'lng' => 110.4589],
            ['kelurahan' => 'Mangunharjo', 'lat' => -7.0489, 'lng' => 110.4623],
        ],
        'Pedurungan' => [
            ['kelurahan' => 'Pedurungan Kidul', 'lat' => -6.9956, 'lng' => 110.4823],
            ['kelurahan' => 'Pedurungan Tengah', 'lat' => -6.9889, 'lng' => 110.4789],
            ['kelurahan' => 'Plamongan Sari', 'lat' => -7.0012, 'lng' => 110.4912],
            ['kelurahan' => 'Muktiharjo Kidul', 'lat' => -7.0089, 'lng' => 110.4856],
            ['kelurahan' => 'Gemah', 'lat' => -6.9923, 'lng' => 110.4867],
        ],
        'Gayamsari' => [
            ['kelurahan' => 'Gayamsari', 'lat' => -6.9789, 'lng' => 110.4456],
            ['kelurahan' => 'Sambirejo', 'lat' => -6.9823, 'lng' => 110.4389],
            ['kelurahan' => 'Pandean Lamper', 'lat' => -6.9867, 'lng' => 110.4512],
            ['kelurahan' => 'Kaligawe', 'lat' => -6.9756, 'lng' => 110.4423],
            ['kelurahan' => 'Siwalan', 'lat' => -6.9712, 'lng' => 110.4478],
        ],
        'Candisari' => [
            ['kelurahan' => 'Candi', 'lat' => -7.0234, 'lng' => 110.4123],
            ['kelurahan' => 'Karanganyar Gunung', 'lat' => -7.0289, 'lng' => 110.4089],
            ['kelurahan' => 'Wonotingal', 'lat' => -7.0312, 'lng' => 110.4156],
            ['kelurahan' => 'Jatingaleh', 'lat' => -7.0267, 'lng' => 110.4201],
            ['kelurahan' => 'Kaliwiru', 'lat' => -7.0198, 'lng' => 110.4078],
        ],
        'Banyumanik' => [
            ['kelurahan' => 'Banyumanik', 'lat' => -7.0623, 'lng' => 110.4089],
            ['kelurahan' => 'Srondol Kulon', 'lat' => -7.0567, 'lng' => 110.4012],
            ['kelurahan' => 'Srondol Wetan', 'lat' => -7.0589, 'lng' => 110.4156],
            ['kelurahan' => 'Sumurboto', 'lat' => -7.0701, 'lng' => 110.4234],
            ['kelurahan' => 'Gedawang', 'lat' => -7.0656, 'lng' => 110.3989],
        ],
    ];

    // Jenis UMKM yang realistis untuk Semarang
    private static $jenisUsaha = [
        'Makanan & Minuman' => [
            'Warung Makan', 'Catering', 'Bakery & Cake Shop', 'Kedai Kopi', 'Resto Seafood',
            'Warung Nasi', 'Depot Es', 'Angkringan', 'Kedai Jamu', 'Penjual Bandeng Presto',
            'Lumpia Semarang', 'Wingko Babat', 'Toko Roti', 'Pecel Lele', 'Warteg',
        ],
        'Fashion & Konveksi' => [
            'Konveksi Seragam', 'Sablon Kaos', 'Butik Muslimah', 'Toko Sepatu', 'Jahit Pakaian',
            'Bordir Komputer', 'Konveksi Tas', 'Jual Baju Anak', 'Distro Lokal', 'Tailor Jas',
        ],
        'Kerajinan' => [
            'Kerajinan Kayu', 'Souvenir Pernikahan', 'Handy Craft', 'Kerajinan Rotan',
            'Kerajinan Kulit', 'Kerajinan Gerabah', 'Aksesori Fashion', 'Kerajinan Batik',
        ],
        'Jasa' => [
            'Salon & Barbershop', 'Laundry', 'Service Elektronik', 'Bengkel Motor',
            'Fotocopy & Printing', 'Studio Photo', 'Les Privat', 'Kursus Komputer',
            'Jasa Desain Grafis', 'Service HP', 'Cuci Motor', 'Bengkel Las',
        ],
        'Perdagangan' => [
            'Toko Kelontong', 'Minimarket', 'Toko Bangunan', 'Toko Elektronik',
            'Toko Sepeda', 'Toko Spare Part', 'Toko Alat Tulis', 'Apotik',
        ],
    ];

    public function definition(): array
    {
        // Pilih lokasi random
        $kecamatan = fake()->randomElement(array_keys(self::$locations));
        $location = fake()->randomElement(self::$locations[$kecamatan]);
        
        // Pilih jenis usaha
        $kategori = fake()->randomElement(array_keys(self::$jenisUsaha));
        $jenisUsaha = fake()->randomElement(self::$jenisUsaha[$kategori]);
        
        // Generate nama usaha yang unik
        $prefix = fake()->randomElement(['UD', 'CV', 'Toko', 'Warung', 'Kedai', 'Usaha', '']);
        $namaUsaha = trim($prefix . ' ' . $jenisUsaha . ' ' . fake()->randomElement([
            fake()->firstName(),
            fake()->lastName(),
            'Berkah',
            'Jaya',
            'Maju',
            'Sejahtera',
            'Makmur',
            'Mandiri',
            'Sentosa',
            'Abadi',
            fake()->numberBetween(1, 99),
        ]));

        // Omzet realistis berdasarkan kategori
        $omzetRanges = [
            'Makanan & Minuman' => [3000000, 50000000],
            'Fashion & Konveksi' => [5000000, 100000000],
            'Kerajinan' => [2000000, 30000000],
            'Jasa' => [2500000, 40000000],
            'Perdagangan' => [10000000, 200000000],
        ];
        
        [$minOmzet, $maxOmzet] = $omzetRanges[$kategori];
        $omzet = fake()->numberBetween($minOmzet, $maxOmzet);

        // Jumlah tenaga kerja proporsional dengan omzet
        $tenagaKerja = match(true) {
            $omzet < 5000000 => fake()->numberBetween(1, 2),
            $omzet < 15000000 => fake()->numberBetween(2, 5),
            $omzet < 50000000 => fake()->numberBetween(5, 10),
            default => fake()->numberBetween(10, 20),
        };

        // Variasi koordinat sedikit untuk realisme
        $latVariation = fake()->randomFloat(4, -0.01, 0.01);
        $lngVariation = fake()->randomFloat(4, -0.01, 0.01);

        // Status verifikasi: 70% terverifikasi, 30% pending
        $isVerified = fake()->boolean(70);

        return [
            'user_id' => null, // Will be set in seeder
            'nama_usaha' => $namaUsaha,
            'alamat_lengkap' => fake()->streetAddress() . ', ' . $location['kelurahan'] . ', Kec. ' . $kecamatan,
            'kecamatan' => $kecamatan,
            'kelurahan' => $location['kelurahan'],
            'latitude' => $location['lat'] + $latVariation,
            'longitude' => $location['lng'] + $lngVariation,
            'omzet_bulanan' => $omzet,
            'jumlah_tenaga_kerja' => $tenagaKerja,
            'is_verified' => $isVerified,
            'verified_at' => $isVerified ? fake()->dateTimeBetween('-6 months', 'now') : null,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => false,
            'verified_at' => null,
        ]);
    }

    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => true,
            'verified_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ]);
    }
}
