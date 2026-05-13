<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $watchNames = [
            'Precision Chronograph',
            'Elegance Perpetual',
            'Aurora Luminous',
            'Odyssey Navigator',
            'Dynasty Masterpiece',
            'Zenith Infinity',
            'Platinum Eclipse',
            'Sapphire Essence',
            'Gold Legacy',
            'Silver Quantum',
            'Obsidian Shadow',
            'Crystal Harmony',
            'Titanium Horizon',
            'Diamond Majesty',
            'Pearl Celestial',
        ];

        $watchCategories = ['Men\'s Watches', 'Women\'s Watches', 'Automatic', 'Quartz', 'Luxury Collection'];
        
        // Array of luxury watch images from Unsplash
        $watchImages = [
            'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1509941943102-1c9fdd9e1520?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1526045612212-70caf35b4884?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1505056066834-acfe5b3f54d0?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1564622506233-fbcd465ff780?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1547996881-7db045d4d772?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1587836374828-4dbafa94cf0e?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1612817288484-5d3f3f2e5b67?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1591857212131-41b908a3133a?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1552347619-cfee7c37f57b?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1539874754764-5a96559165d0?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1569411175566-31394adfd838?w=500&h=500&fit=crop',
            'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=500&h=500&fit=crop',
        ];
        
        $name = $this->faker->randomElement($watchNames) . ' ' . $this->faker->numberBetween(100, 999);
        
        // PKR prices for luxury watches (15,000 to 500,000 PKR)
        $price = $this->faker->numberBetween(15000, 500000);
        $salePrice = null;
        
        // 40% chance of sale price
        if ($this->faker->boolean(40)) {
            $discount = $this->faker->numberBetween(10, 30); // 10-30% discount
            $salePrice = $price - ($price * $discount / 100);
        }
        
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => 'Exquisite timepiece crafted with precision and elegance. ' . $this->faker->sentence(6) . ' Features include sapphire crystal, water resistance, and automatic movement.',
            'price' => $price,
            'sale_price' => $salePrice,
            'stock' => $this->faker->numberBetween(2, 50),
            'category' => $this->faker->randomElement($watchCategories),
            'image' => $this->faker->randomElement($watchImages),
            'is_featured' => $this->faker->boolean(30),
        ];
    }
}
