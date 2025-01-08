<?php

namespace App\Charts;

use App\Models\AllUmkm;
use App\Models\Category;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CityChart
{
    protected $chart2;

    public function __construct(LarapexChart $chart2)
    {
        $this->chart2 = $chart2;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        // Ambil data jumlah UMKM per kota
        $cities = AllUmkm::select('city_id')
                         ->selectRaw('count(*) as umkm_count')
                         ->groupBy('city_id')
                         ->with('city')  // Menyertakan relasi kota
                         ->get();
        
        // Hitung total UMKM
        $totalUmkm = AllUmkm::count();
    
        // Persiapkan data untuk pie chart
        $labels = $cities->pluck('city.name'); // Ambil nama kota
        $data = $cities->map(function ($city) use ($totalUmkm) {
            return round(($city->umkm_count / $totalUmkm) * 100, 2); // Hitung persentase
        });
    
        // Buat Pie Chart
        return $this->chart2->pieChart()
            ->setTitle('Distribusi UMKM Berdasarkan Kota')
            ->setSubtitle('Perbandingan UMKM Berdasarkan Kota dengan Persentase')
            ->addData($data->toArray()) // Data persentase untuk chart
            ->setLabels($labels->toArray()) // Label kota untuk chart
            ->setHeight(400);
    }
    
    }
