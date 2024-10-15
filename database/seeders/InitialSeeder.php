<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('heroes')->insert([
            ['title' => 'DELIVERING QUALITY PRODUCTS & SUSTAINABLE WASTE MANAGEMENT', 'subtitle' => 'Solusi Terdepan untuk Menghasilkan Produk Bermutu Tinggi dan Menangani Limbah secara Berkelanjutan.', 'video_url' => 'https://www.youtube.com/watch?v=KeZPke-i3iM'],
        ]);
        DB::table('services')->insert([
            ['title' => 'OUR SERVICES', 'desc' => 'PT. Berkatindo Nusantara Bersinar bergerak dalam pembangunan Instalasi Pengolahan Air Limbah (IPAL), Instalasi Pengolahan Air Minum (IPAM), Distributor Bahan Kimia dan Pengurusan Izin Lingkungan. Dengan Bidang Garapan Usaha antara lain :', 'image_url' => 'images/service-4.jpeg'],
        ]);
    }
}
