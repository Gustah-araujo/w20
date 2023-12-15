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
        $keyboard = Category::where('name', '=', 'Teclados')->first();
        $chair = Category::where('name', '=', 'Cadeiras')->first();
        $processor = Category::where('name', '=', 'Processadores')->first();
        $gpu = Category::where('name', '=', 'Placas gráficas')->first();
        $mobo = Category::where('name', '=', 'Placas mãe')->first();

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
                'name' => 'Teclado de membrana'
            ],
            [
                'price' => 4999,
                'description' => 'Teclado simples de escritório',
                'image' => 'https://m.media-amazon.com/images/I/511szdKRorL._AC_UF1000,1000_QL80_.jpg',
                'category_id' => $keyboard->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Teclado mecânico'
            ],
            [
                'price' => 24599,
                'description' => 'Teclado mecânico cheio de LEDs',
                'image' => 'https://a-static.mlcdn.com.br/450x450/teclado-mecanico-gamer-philco-pkb92-aluminum-brown/altoacessorios/0604be6a7ebe11eda78d4201ac185019/c31ab804380e4eaa0b54113e8c34b6ce.jpeg',
                'category_id' => $keyboard->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Cadeira de escritório'
            ],
            [
                'price' => 34999,
                'image' => 'https://images-americanas.b2w.io/produtos/2448021221/imagens/cadeira-para-escritorio-confortavel-diretor-ergonomica-giratoria-anima-para-escrivaninha/2448021230_1_large.jpg',
                'category_id' => $chair->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Cadeira gamer'
            ],
            [
                'price' => 79999,
                'image' => 'https://images.tcdn.com.br/img/img_prod/740836/cadeira_gamer_concordia_gm3_rgb_com_controle_e_powerbank_10803_1_20a776245ed6e9b1bd655072771901e6.png',
                'category_id' => $chair->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Processador Intel I7'
            ],
            [
                'price' => 11099,
                'image' => 'https://images.tcdn.com.br/img/img_prod/313499/processador_intel_core_i7_12700_2_1ghz_4_9ghz_turbo_12a_geracao_12_cores_20_threads_lga_1700_com_coo_17271_1_90904782757814888e3f75cc41cdc5d0.jpg',
                'category_id' => $processor->id
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
                'name' => 'Placa de vídeo GEFORCE RTX 4080'
            ],
            [
                'price' => 238999,
                'image' => 'https://img.terabyteshop.com.br/produto/g/placa-de-video-msi-nvidia-geforce-rtx-4080-gaming-x-trio-16gb-gddr6x-dlss-ray-tracing-912-v511-046_170257.png',
                'category_id' => $gpu->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Placa de vídeo Radeon RX 6900 xt'
            ],
            [
                'price' => 119999,
                'image' => 'https://images.tcdn.com.br/img/img_prod/1144186/placa_de_video_sapphire_rx_6900_16gb_xt_nitro_amd_radeon_2285mhz_gddr6_2919_2_431bc32b6070f785917ff5e50537479f.jpg',
                'category_id' => $gpu->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Placa mãe Aorus B550M'
            ],
            [
                'price' => 99999,
                'image' => 'https://marketplace.bancointer.com.br/ecommerce/catalog/images/olist/OCPACODVNYIDPMV4/olist-OCPACODVNYIDPMV4-382712495-447216183.png',
                'category_id' => $mobo->id
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'Placa mãe Gigabyte B450'
            ],
            [
                'price' => 59999,
                'image' => 'https://img.terabyteshop.com.br/produto/g/placa-mae-gigabyte-b450m-gaming-ddr4-am4_71249.jpg',
                'category_id' => $mobo->id
            ]
        );
    }
}
