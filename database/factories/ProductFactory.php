<?php

namespace Database\Factories;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(5),
            'price' => $this->faker->numberBetween(1000,1000000),
            'category_product_id' => CategoryProduct::inRandomOrder()->first()->id,
            'user_id' => 1,
            'image_path' => null
        ];
    }


public function configure(): static
{
    return $this->afterCreating(function (Product $product) {
        // Fuerza URL “raw” sin subdominios extraños
        $url = 'https://picsum.photos/640/480';

        try {
            $response = Http::timeout(5)->get($url);
            if (! $response->ok()) {
                return;
            }
        } catch (\Exception $e) {
            // No pudo descargar: salimos silenciosos
            return;
        }

        $fileName = Str::slug($product->name).'_'.Str::random(4).'.jpg';
        $path     = "products/{$fileName}";

        Storage::disk('public')->put($path, $response->body());
        $product->update(['image_path' => $path]);
    });
}

}
