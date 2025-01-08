<?php

namespace App\Charts;

use App\Models\Category;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UmkmChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Fetch the categories and count the number of UMKMs in each category
        $categories = Category::withCount('allumkm')->get();

        // Prepare data for the bar chart
        $labels = $categories->pluck('name');  // Category names
        $data = $categories->pluck('allumkm_count');  // Count of UMKMs in each category

        // Create the bar chart
        return $this->chart->barChart()
            ->setTitle('Kategori')
            ->setSubtitle('Kategori dengan Jumlah UMKM Terbanyak')
            ->addData('Jumlah', $data->toArray())  // Data for the chart
            ->setLabels($labels->toArray())  // Labels for the chart
            ->setHeight(400)
            ->setColors(['#FF5733']);  // Optional: You can customize the color

    }
}
