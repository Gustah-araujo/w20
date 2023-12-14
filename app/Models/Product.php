<?php

namespace App\Models;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasSku;

    protected $casts = [
        'expires_at' => 'date:d/m/Y',
    ];

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category_id',
        'expires_at',
    ];

    /**
     * Relationships
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
