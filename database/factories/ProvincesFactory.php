<?php

namespace Database\Factories;

use App\Models\Provinces;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provinces>
 */
class ProvincesFactory extends Factory
{
    protected $model = Provinces::class;

    public function definition()
    {
        $provinces = [
            'Aceh', 'Bali', 'Banten', 'Bengkulu', 'Gorontalo', 'Jakarta', 'Jambi', 'Jawa Barat', 'Jawa Tengah',
            'Jawa Timur', 'Kalimantan Barat', 'Kalimantan Selatan', 'Kalimantan Tengah', 'Kalimantan Timur',
            'Kalimantan Utara', 'Kepulauan Bangka Belitung', 'Kepulauan Riau', 'Lampung', 'Maluku', 'Maluku Utara',
            'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Papua', 'Papua Barat', 'Riau', 'Sulawesi Barat', 
            'Sulawesi Selatan', 'Sulawesi Tengah', 'Sulawesi Tenggara', 'Sulawesi Utara', 'Sumatera Barat', 
            'Sumatera Selatan', 'Sumatera Utara', 'Yogyakarta'
        ];

        return [
            'name' => $this->faker->randomElement($provinces),
            'code' => $this->faker->unique()->numberBetween(1, 34), // Optionally use code if needed
        ];
    }

}
