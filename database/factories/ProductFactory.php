<?php

namespace Database\Factories;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /** Nombres de ejemplo por categoría */
    protected array $productNamesMap = [
        'Despensa'            => ['Arroz integral', 'Frijoles negros', 'Harina de trigo', 'Azúcar morena', 'Aceite de oliva'],
        'Limpieza'            => ['Detergente líquido', 'Jabón en polvo', 'Limpiavidrios', 'Esponja multiusos', 'Desinfectante'],
        'Higiene y belleza'   => ['Champú nutritivo', 'Jabón corporal', 'Crema hidratante', 'Enjuague bucal', 'Perfume ligero'],
        'Antojos'             => ['Chocolate amargo', 'Galletas de avena', 'Papas fritas', 'Refresco artesanal', 'Barra de cereal'],
    ];

    /** Descripciones en español por categoría */
    protected array $descriptionMap = [
        'Despensa' => [
            'Este producto es imprescindible en tu despensa diaria.',
            'Ingredientes de calidad para tus mejores recetas.',
            'Perfecto para complementar tu stock de alimentos.',
            'Ideal para preparar platillos caseros.',
            'Sabor auténtico y fresco en cada paquete.',
        ],
        'Limpieza' => [
            'Mantén tu hogar impecable con este producto.',
            'Fórmula potente para eliminar la suciedad más difícil.',
            'Eficacia probada para uso diario.',
            'Deja un aroma fresco y limpio.',
            'Limpieza profunda sin dañar las superficies.',
        ],
        'Higiene y belleza' => [
            'Cuida tu piel con ingredientes naturales.',
            'Fórmula suave adecuada para todo tipo de piel.',
            'Hidratación intensa y duradera.',
            'Aroma delicado para tu rutina diaria.',
            'Calidad profesional para tu cuidado personal.',
        ],
        'Antojos' => [
            'Disfruta de un snack delicioso en cualquier momento.',
            'Satisfacción garantizada para tus antojos.',
            'Crujiente y sabroso, ideal para compartir.',
            'Perfecto para acompañar tu bebida favorita.',
            'Pequeño placer para alegrar tu día.',
        ],
    ];

    public function definition(): array
    {
        // Faker en español para datos adicionales si hiciera falta
        $fakerEs = \Faker\Factory::create('es_ES');

        // Elijo categoría al azar
        $category = CategoryProduct::inRandomOrder()->first();
        

        // Nombre contextual según categoría
        $names = $this->productNamesMap[$category->name] 
               ?? [$fakerEs->word()];
        $name = $fakerEs->randomElement($names);

        // Descripción 100% en español, de la lista según categoría
        $descs = $this->descriptionMap[$category->name] 
               ?? ["Producto de la categoría {$category->name}."];
        $description = $fakerEs->randomElement($descs);

        return [
            'name'                => $name,
            'description'         => $description,
            'price'               => $fakerEs->numberBetween(1000, 1000000),
            'category_product_id' => $category->id,
            'user_id'             => $fakerEs->numberBetween(1, 3),
            'image_path'          => null,
            'points'              => $fakerEs->numberBetween(0, 500),
            'expiration_date' => date('Y-m-d H:i:s', $fakerEs->unixTime(strtotime('+3 weeks'))),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $categoryName = CategoryProduct::find($product->category_product_id)->name;
            // Genero un slug único por categoría+ID para la semilla
            $seed = Str::slug("{$categoryName}-{$product->id}", '-');
            // Picsum con semilla: siempre responde 200 OK y sin redirects
            $url = "https://picsum.photos/seed/{$seed}/640/480";

            try {
                $response = Http::timeout(10)->get($url);
                if (! $response->ok()) {
                    return;
                }
            } catch (\Exception $e) {
                return;
            }

            $fileName = Str::slug($product->name, '_') . '_' . Str::random(5) . '.jpg';
            $path     = "products/{$fileName}";

            Storage::disk('public')->put($path, $response->body());
            $product->update(['image_path' => $path]);
        });
    }
}
