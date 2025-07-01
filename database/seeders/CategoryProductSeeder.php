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
            [ 'id' => 1,  'name' => 'Alimentos y Bebidas',            'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 2,  'name' => 'Ropa y Calzado',                 'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 3,  'name' => 'Electrónica y Accesorios',       'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 4,  'name' => 'Muebles y Decoración',           'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 5,  'name' => 'Artículos para Bebés y Niños',   'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 6,  'name' => 'Mascotas y Accesorios',          'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 7,  'name' => 'Hogar y Jardín',                 'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 8,  'name' => 'Deportes y Fitness',             'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 9,  'name' => 'Belleza y Cuidado Personal',     'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 10, 'name' => 'Herramientas y Ferretería',      'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 11, 'name' => 'Libros y Papelería',             'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 12, 'name' => 'Automóviles y Repuestos',        'created_at' => now(), 'updated_at' => now() ],
        ];

        CategoryProduct::insert($categories);
    }
}
