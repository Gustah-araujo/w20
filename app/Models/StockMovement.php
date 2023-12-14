<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'previous_stock',
        'new_stock',
        'product_id',
        'amount',
    ];

    protected $casts = [
        'date' => 'date:d/m/Y'
    ];

    /**
     * Mutators
     */

    public function type() : Attribute
    {
        return Attribute::make(
            get: function($value) {
                if ($this->amount > 0) {
                    return 'Entrada';
                }

                if ($this->amount < 0) {
                    return 'Saída';
                }
            }
        );
    }

    public function typeStyle() : Attribute
    {
        return Attribute::make(
            get: function($value) {
                if ($this->amount > 0) {
                    return 'success';
                }

                if ($this->amount < 0) {
                    return 'danger';
                }
            }
        );
    }
}
