<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mouse = Category::where('name', '=', 'Mouses')->first();
        $processor = Category::where('name', '=', 'Processadores')->first();

        Product::firstOrCreate(
            [
                'name' => 'Mouse simples'
            ],
            [
                'price' => 2500,
                'description' => 'Apenas um mouse simples',
                'image' => 'https://www.logitechstore.com.br/media/catalog/product/cache/1/image/634x545/9df78eab33525d08d6e5fb8d27136e95/9/1/910-001601.png',
                'category_id' => $mouse->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Mouse gamer'
            ],
            [
                'price' => 17500,
                'description' => 'Mouse gamer repleto de LEDs',
                'image' => 'https://cdn.awsli.com.br/600x1000/357/357447/produto/148548310/de87d0cdf3.jpg',
                'category_id' => $mouse->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Processador AMD Ryzen 7'
            ],
            [
                'price' => 89999,
                'image' => 'https://m.media-amazon.com/images/I/61IIbwz-+ML._AC_UF894,1000_QL80_.jpg',
                'category_id' => $processor->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Processador Intel I7'
            ],
            [
                'price' => 119999,
                'image' => 'https://images.tcdn.com.br/img/img_prod/313499/processador_intel_core_i7_12700_2_1ghz_4_9ghz_turbo_12a_geracao_12_cores_20_threads_lga_1700_com_coo_17271_1_90904782757814888e3f75cc41cdc5d0.jpg',
                'category_id' => $processor->id
            ]
        );
    }
}
