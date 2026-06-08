<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TravelPackages extends Model
{
    use HasFactory;

    protected $table = "travel_packages";
    protected $fillable = [
        'title',
        'slug',
        'type',
        'location',
        'country',
        'price',
        'description',
        'images',
        'mobile_images',
        'min_pax',
        'discount',
        'discount_price',
        'start_date',
        'end_date',
        'is_active',
        'is_featured',
        'travel_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(TravelCategory::class, 'travel_category_id');
    }

    protected $casts = [
        'images' => 'array',
        'mobile_images' => 'array',
        'country' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            // Cek jika properti 'images' telah diperbarui
            if ($model->isDirty('images')) {
                $originalImages = $model->getOriginal('images');
                $newImages = $model->images;

                // Hapus gambar yang ada di originalImages tetapi tidak ada di newImages
                if (is_array($originalImages)) {
                    // Cek apakah gambar yang lama ada di array gambar yang baru
                    foreach ($originalImages as $originalImage) {
                        if ($originalImage && !in_array($originalImage, $newImages)) {
                            // Hapus gambar yang tidak ada lagi di newImages
                            Storage::disk('public')->delete($originalImage);
                        }
                    }
                }
            }
        });

        static::deleting(function ($model) {
            // Hapus file gambar saat model dihapus
            if (is_array($model->images)) {
                foreach ($model->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            } else {
                Storage::disk('public')->delete($model->images);
            }
        });
    }
}
