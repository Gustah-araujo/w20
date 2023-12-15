<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class HasStock implements ValidationRule, DataAwareRule
{
    public Product $product;
    protected $data = [];

    public function __construct(string $product_id)
    {
        $this->product = Product::find($product_id);
    }

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( $this->data['type'] == 'out' ) {
            $result_stock = $this->product->stock - intval($value);

            if ( $result_stock < 0 ) {
                $fail('validation.amount.insufficient_stock')->translate();
            }
        }
    }
}
