<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate([
            'name' => 'Mouses'
        ]);

        Category::firstOrCreate([
            'name' => 'Teclados'
        ]);

        Category::firstOrCreate([
            'name' => 'Cadeiras'
        ]);

        Category::firstOrCreate([
            'name' => 'Processadores'
        ]);

        Category::firstOrCreate([
            'name' => 'Placas gráficas'
        ]);

        Category::firstOrCreate([
            'name' => 'Placas mãe'
        ]);
    }
}
