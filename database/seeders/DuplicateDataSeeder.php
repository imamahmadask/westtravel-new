<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TravelCategory;
use App\Models\TravelPackages;

class DuplicateDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Definisikan koneksi dinamis ke database source wtravel-filament
        config([
            'database.connections.source_db' => [
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'port' => '3306',
                'database' => 'westtrav_westtravel',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
            ]
        ]);

        // 2. Buat/Update Kategori Utama di westtravel-new
        $categories = [
            'lombok' => TravelCategory::updateOrCreate(['slug' => 'lombok'], ['name' => 'Lombok']),
            'sumbawa' => TravelCategory::updateOrCreate(['slug' => 'sumbawa'], ['name' => 'Sumbawa']),
            'intl' => TravelCategory::updateOrCreate(['slug' => 'intl'], ['name' => 'Luar Negeri']),
        ];

        $this->command->info('Kategori utama berhasil disiapkan.');

        // Hapus data paket lama agar tidak duplikat saat seeder dijalankan ulang
        TravelPackages::truncate();

        // 3. Tarik data travel_packages dari database wtravel-filament
        $sourcePackages = DB::connection('source_db')->table('travel_packages')->get();

        foreach ($sourcePackages as $pkg) {
            // Tentukan pemetaan kategori
            $group = $pkg->group_package ?? 'Other';
            $loc = strtolower($pkg->location ?? '');
            $title = strtolower($pkg->title ?? '');
            
            // Cek data country
            $countryArr = json_decode($pkg->country ?? '', true) ?: [];
            if (empty($countryArr)) {
                $countryArr = ['Indonesia'];
            }
            
            $catSlug = 'lombok'; // Default kategori
            
            if ($group === 'International Package' || (is_array($countryArr) && count($countryArr) > 0 && !in_array('Indonesia', $countryArr))) {
                $catSlug = 'intl';
            } elseif (
                str_contains($loc, 'moyo') || 
                str_contains($loc, 'sumbawa') || 
                str_contains($loc, 'maluk') || 
                str_contains($title, 'moyo') || 
                str_contains($title, 'sumbawa') || 
                str_contains($title, 'saleh')
            ) {
                $catSlug = 'sumbawa';
            }

            $categoryId = $categories[$catSlug]->id;

            // Masukkan data paket baru ke westtravel-new dengan fallback untuk field NOT NULL
            TravelPackages::create([
                'id'                 => $pkg->id,
                'title'              => $pkg->title ?? 'Untitled Package',
                'slug'               => $pkg->slug ?? 'untitled-package-' . $pkg->id,
                'type'               => $pkg->type ?? 'Tour',
                'location'           => $pkg->location ?? 'Lombok',
                'country'            => $countryArr,
                'price'              => $pkg->price ?? 0,
                'description'        => $pkg->description ?? '',
                'images'             => json_decode($pkg->images ?? '', true) ?: [],
                'mobile_images'      => json_decode($pkg->mobile_images ?? '', true) ?: [],
                'min_pax'            => $pkg->min_pax ?? '2',
                'discount'           => $pkg->disc,
                'discount_price'     => $pkg->disc_price,
                'is_active'          => $pkg->is_active ?? true,
                'is_featured'        => $pkg->is_popular ?? false,
                'travel_category_id' => $categoryId,
                'start_date'         => null,
                'end_date'           => null,
            ]);

            $this->command->info("Paket Wisata '{$pkg->title}' berhasil diduplikasi ke kategori '{$catSlug}'.");
        }

        $this->command->info('Seluruh data travel_packages berhasil diduplikasi!');
    }
}
