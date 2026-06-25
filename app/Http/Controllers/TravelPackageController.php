<?php

namespace App\Http\Controllers;

use App\Models\TravelPackages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TravelPackageController extends Controller
{
    public function index()
    {
        $packages = TravelPackages::with('category')->where('is_active', true)->get();
        return view('packages', compact('packages'));
    }

    public function show($slug)
    {
        $package = TravelPackages::with('category')->where('slug', $slug)->firstOrFail();
        
        // Map Eloquent model to the array structure expected by the package-detail view
        $mappedPackage = [
            'slug'          => $package->slug,
            'name'          => $package->title,
            'category'      => $package->category->name ?? 'Lombok',
            'badge_class'   => 'pkg-badge-' . ($package->category->slug ?? 'lombok'),
            'popular_badge' => $package->is_featured ? '🔥 Terpopuler' : null,
            'location'      => $package->location,
            'duration'      => $package->type,
            'min_pax'       => $package->min_pax,
            'language'      => 'Indonesia / Inggris',
            'rating'        => 4.9, // default fallback
            'reviews'       => 120, // default fallback
            'price_display' => 'Rp ' . number_format($package->price / 1000000, 1, ',', '.') . ' Jt',
            'price_raw'     => $package->price,
            'hero_img'      => is_array($package->images) && count($package->images) > 0 ? Storage::url($package->images[0]) : 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1800&q=85',
            'desc'          => Str::limit(strip_tags($package->description), 150),
            'desc_long'     => $package->description,
            'map_embed'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31625.408!2d116.105!3d-8.352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdb5ab6a946e4b%3A0x5f49e5ca9c2e16a8!2sGili%20Trawangan!5e0!3m2!1sen!2sid!4v1',
            'gallery'       => is_array($package->images) ? array_map(fn($img) => Storage::url($img), $package->images) : [],
            'highlights'    => [
                ['icon' => 'fas fa-hotel', 'title' => 'Akomodasi Premium', 'sub' => 'Penginapan nyaman pilihan terbaik'],
                ['icon' => 'fas fa-user-tie', 'title' => 'Tour Guide', 'sub' => 'Pemandu wisata profesional berpengalaman'],
                ['icon' => 'fas fa-utensils', 'title' => 'Makan & Sarapan', 'sub' => 'Sarapan tersedia selama tour'],
                ['icon' => 'fas fa-camera', 'title' => 'Dokumentasi', 'sub' => 'Layanan dokumentasi foto perjalanan'],
            ],
            'itinerary'     => [], // default fallback empty
            'includes'      => ['Transportasi AC selama tour', 'Tiket masuk destinasi wisata', 'Pemandu wisata profesional', 'Air mineral'],
            'excludes'      => ['Tiket pesawat PP', 'Pengeluaran pribadi', 'Tips guide & driver'],
            'notes'         => ['Jadwal dapat berubah menyesuaikan kondisi cuaca.', 'Minimal pemesanan untuk 2 orang.'],
            'review_list'   => [
                ['name' => 'Rina Kartika', 'date' => 'Mei 2025', 'rating' => 5, 'text' => 'Paket wisata yang sangat luar biasa! Pelayanan guide ramah dan profesional. Sangat direkomendasikan.'],
                ['name' => 'Budi Santoso', 'date' => 'April 2025', 'rating' => 5, 'text' => 'Semua sesuai dengan itinerary, sangat puas liburan bersama WestTravel!'],
            ],
            'related'       => TravelPackages::where('id', '!=', $package->id)
                                ->where('is_active', true)
                                ->inRandomOrder()
                                ->take(3)
                                ->get()
                                ->map(fn($p) => [
                                    'slug' => $p->slug,
                                    'name' => $p->title,
                                    'category' => $p->category->name ?? 'Lombok',
                                    'badge_class' => 'pkg-badge-' . ($p->category->slug ?? 'lombok'),
                                    'duration' => $p->type,
                                    'price' => 'Rp ' . number_format($p->price / 1000000, 1, ',', '.') . ' Jt',
                                    'img' => is_array($p->images) && count($p->images) > 0 ? Storage::url($p->images[0]) : 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=700&q=80',
                                    'desc' => Str::limit(strip_tags($p->description), 100),
                                ])
                                ->toArray()
        ];
        
        return view('package-detail', ['package' => $mappedPackage]);
    }
}
