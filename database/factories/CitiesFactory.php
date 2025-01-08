<?php

namespace Database\Factories;

use App\Models\Cities;
use App\Models\Provinces;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cities>
 */
class CitiesFactory extends Factory
{
    protected $model = Cities::class;

    public function definition()
    {
        // Daftar kota di Jawa Timur
        $cities = [
            'Surabaya', 'Malang', 'Kediri', 'Blitar', 'Probolinggo', 'Banyuwangi', 'Sidoarjo', 'Pasuruan', 'Mojokerto',
            'Jember', 'Lumajang', 'Tuban', 'Bangkalan', 'Ponorogo', 'Ngawi', 'Pacitan', 'Trenggalek', 'Bondowoso',
            'Situbondo', 'Sampang', 'Sumenep', 'Madiun', 'Nganjuk', 'Magetan', 'Tulungagung', 'Ngawi', 'Bojonegoro',
            'Kediri', 'Gresik', 'Lamongan', 'Jombang', 'Jember', 'Pamekasan', 'Ponorogo'
        ];

        // Mendapatkan ID Provinsi Jawa Timur
        $provinceId = Provinces::where('name', 'Jawa Timur')->first()->id;

        return [
            'name' => $this->faker->randomElement($cities),
            'province_id' => $provinceId, // Relasi dengan Provinsi Jawa Timur
        ];
    }
}
