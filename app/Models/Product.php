<?php

namespace App\Models;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'stock',
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

    public function stock_movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Mutators
     */

    public function price() : Attribute
    {
        return Attribute::make(
            get: function($value) {
                return "R$ " . number_format($value / 100, 2, ',', '.');
            }
        );
    }

    public function priceInt() : Attribute
    {
        return Attribute::make(
            get: function($value) {
                return $this->getRawOriginal('price');
            }
        );
    }
}
