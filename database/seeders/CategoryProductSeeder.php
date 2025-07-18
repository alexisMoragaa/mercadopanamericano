<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id'            =>  1,
                'name'          =>  'Despensa',
                'color'         =>  '#C19A6B',
                'image_path'    =>  'categories/despensa.jpg',
                'created_at'    =>  now(),
                'updated_at'    =>  now(),
            ],
            [
                'id'            =>  2,
                'name'          =>  'Limpieza',
                'color'         =>  '#6BAED6',
                'image_path'    =>  'categories/limpieza.jpg',
                'created_at'    =>  now(),
                'updated_at'    =>  now(),
            ],
            [
                'id'            =>  3,
                'name'          =>  'Higiene y belleza',
                'color'         =>  '#B59BB8',
                'image_path'    =>  'categories/belleza.jpg',
                'created_at'    =>  now(),
                'updated_at'    =>  now(),
            ],
            [
                'id'            =>  4,
                'name'          =>  'Antojos',
                'color'         =>  '#A65F3E',
                'image_path'    =>  'categories/antojos.jpg',
                'created_at'    =>  now(),
                'updated_at'    =>  now(),
            ],
        ];


        CategoryProduct::insert($categories);
    }
}
