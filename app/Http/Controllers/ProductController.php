<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $promos = [
            [
                'name' => 'Bika Ambon Durian',
                'image' => 'https://img-global.cpcdn.com/recipes/7d1727f5e2843ae1/680x482cq70/bika-ambon-durian-foto-resep-utama.jpg',
                'description' => 'Aroma durian khas yang menggoda selera.',
                'price' => 35000,
                'original_price' => 45000,
                'slug' => 'durian'
            ],
            [
                'name' => 'Bika Ambon Red Velvet',
                'image' => 'https://img-global.cpcdn.com/recipes/ebe18c5d03384af6/680x482cq70/bika-ambon-red-velvet-anti-gagal-foto-resep-utama.jpg',
                'description' => 'Rasa unik untuk pecinta Red Velvet.',
                'price' => 32000,
                'original_price' => 42000,
                'slug' => 'matcha'
            ],
            [
                'name' => 'Bika Ambon Original',
                'image' => 'https://pemerintahsumut.wordpress.com/wp-content/uploads/2014/12/bika-ambon.jpg',
                'description' => 'Rasa klasik yang tak pernah gagal memanjakan lidah.',
                'price' => 28000,
                'original_price' => 38000,
                'slug' => 'original'
            ]
        ];

        $variants = [
            [
                'name' => 'Bika Ambon Coklat',
                'image' => 'https://img-global.cpcdn.com/recipes/b6d18cb817e00d92/680x482cq70/bika-ambon-coklat-foto-resep-utama.jpg',
                'description' => 'Kelezatan coklat berpadu dengan tekstur lembut Bika Ambon.'
            ],
            [
                'name' => 'Bika Ambon Pandan',
                'image' => 'https://img-global.cpcdn.com/recipes/8666eec402d3f1f0/680x482cq70/bika-ambon-pandan-foto-resep-utama.jpg',
                'description' => 'Aroma harum pandan yang menggugah selera.'
            ],
            [
                'name' => 'Bika Ambon Keju',
                'image' => 'https://pemerintahsumut.wordpress.com/wp-content/uploads/2014/12/bika-ambon.jpg',
                'description' => 'Taburan keju melimpah, bikin makin nikmat!'
            ]
        ];

        return view('home', compact('promos', 'variants'));
    }
}
