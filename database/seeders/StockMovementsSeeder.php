<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\StockMovement;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockMovementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {

            $date = Carbon::createFromFormat('d/m/Y', '01/01/2023');

            foreach (range(1, 25) as $index) {
                $stock = $product->stock;
                $date = $date->addDays( fake()->numberBetween(1, 10) )->setTime( fake()->time('H'), fake()->time('i') );

                if ($stock < 10) {

                    $amount = fake()->numberBetween(10, 50);

                    StockMovement::create([
                        'product_id' => $product->id,
                        'amount' => $amount,
                        'date' => $date->toDateTimeString()
                    ]);

                    $product->update([
                        'stock' => $stock + $amount
                    ]);

                }

                if ($stock >= 10) {

                    $amount = fake()->numberBetween(1, $stock);

                    StockMovement::create([
                        'product_id' => $product->id,
                        'amount' => -$amount,
                        'date' => $date->toDateTimeString()
                    ]);

                    $product->update([
                        'stock' => $stock - $amount
                    ]);
                }

            }

        }
    }
}
