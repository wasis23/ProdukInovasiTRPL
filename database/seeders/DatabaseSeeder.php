<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@trpl.id'],
            [
                'name' => 'Admin TRPL',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Create Categories
        $categories = [
            [
                'name' => 'Website',
                'slug' => 'website'
            ],
            [
                'name' => 'IoT (Internet of Things)',
                'slug' => 'iot'
            ],
            [
                'name' => 'Games',
                'slug' => 'games'
            ]
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[$cat['slug']] = Category::updateOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name']]
            );
        }

        // 3. Ensure public products directory exists
        Storage::disk('public')->makeDirectory('products');

        // Helper to generate placeholder image
        $generatePlaceholder = function ($filename, $text, $bgColor) {
            $path = Storage::disk('public')->path('products/' . $filename);
            if (file_exists($path)) {
                return 'products/' . $filename;
            }

            // Create image
            $width = 800;
            $height = 500;
            $image = imagecreatetruecolor($width, $height);
            
            // Background
            $r = hexdec(substr($bgColor, 1, 2));
            $g = hexdec(substr($bgColor, 3, 2));
            $b = hexdec(substr($bgColor, 5, 2));
            $color = imagecolorallocate($image, $r, $g, $b);
            imagefill($image, 0, 0, $color);
            
            // Text color (White)
            $textColor = imagecolorallocate($image, 255, 255, 255);
            
            // Draw dummy text lines
            imagestring($image, 5, 50, 200, $text, $textColor);
            imagestring($image, 4, 50, 230, "TRPL Innovation Showcase Product", $textColor);
            
            imagejpeg($image, $path);
            imagedestroy($image);
            
            return 'products/' . $filename;
        };

        // 4. Create Sample Products
        
        // Product 1: Website
        $p1 = Product::updateOrCreate(
            ['slug' => 'smart-campus-portal'],
            [
                'category_id' => $categoryModels['website']->id,
                'title' => 'Smart Campus Portal D4 TRPL',
                'description' => '<p><strong>Smart Campus Portal</strong> adalah platform akademik terintegrasi yang memudahkan mahasiswa dan dosen dalam berinteraksi. Sistem ini mencakup modul administrasi nilai, KRS online, dashboard bimbingan tugas akhir, serta analisis statistik performa mahasiswa berbasis AI.</p><p>Fitur utama:</p><ul><li>Single Sign On (SSO)</li><li>Sistem KRS Interaktif Real-time</li><li>AI Predictor kelulusan mahasiswa</li><li>Desain responsif mobile-friendly</li></ul>',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'live_preview_url' => 'https://laravel.com',
            ]
        );
        $img1 = $generatePlaceholder('website_1.jpg', 'Smart Campus Portal', '#4f46e5');
        ProductImage::create(['product_id' => $p1->id, 'image_path' => $img1]);

        // Product 2: IoT
        $p2 = Product::updateOrCreate(
            ['slug' => 'agro-smart-greenhouse'],
            [
                'category_id' => $categoryModels['iot']->id,
                'title' => 'AgroSmart Greenhouse System',
                'description' => '<p><strong>AgroSmart Greenhouse System</strong> adalah solusi pertanian cerdas berbasis Internet of Things (IoT) yang dirancang untuk mengontrol parameter lingkungan seperti suhu udara, kelembapan tanah, dan intensitas cahaya secara otomatis.</p><p>Sistem ini menggunakan ESP32 sebagai mikrokontroler utama yang dihubungkan ke server cloud menggunakan protokol MQTT. Petani dapat memantau kondisi tanaman dan mengontrol pompa penyiraman secara real-time melalui aplikasi web.</p>',
                'youtube_url' => 'https://www.youtube.com/watch?v=hN_q-_G6AlM',
                'live_preview_url' => null,
            ]
        );
        $img2a = $generatePlaceholder('iot_1.jpg', 'AgroSmart Greenhouse - Hardware', '#059669');
        $img2b = $generatePlaceholder('iot_2.jpg', 'AgroSmart Greenhouse - Sensors', '#0d9488');
        $img2c = $generatePlaceholder('iot_3.jpg', 'AgroSmart Greenhouse - Dashboard', '#0f766e');
        ProductImage::create(['product_id' => $p2->id, 'image_path' => $img2a]);
        ProductImage::create(['product_id' => $p2->id, 'image_path' => $img2b]);
        ProductImage::create(['product_id' => $p2->id, 'image_path' => $img2c]);

        // Product 3: Games
        $p3 = Product::updateOrCreate(
            ['slug' => 'lost-temple-vr'],
            [
                'category_id' => $categoryModels['games']->id,
                'title' => 'Lost Temple: Virtual Reality Exploration',
                'description' => '<p><strong>Lost Temple: VR Exploration</strong> adalah game petualangan imersif bergenre teka-teki yang dibangun menggunakan Unity Engine. Game ini menempatkan pemain sebagai arkeolog yang menjelajahi kuil kuno yang hilang di tengah hutan hujan tropis.</p><p>Dengan dukungan headset Oculus Quest, pemain dapat berinteraksi secara fisik dengan benda-benda di dalam kuil untuk menyelesaikan teka-teki kuno guna mencari jalan keluar.</p>',
                'youtube_url' => 'https://www.youtube.com/watch?v=V-T0p4Vf-iM',
                'live_preview_url' => null,
            ]
        );
        $img3a = $generatePlaceholder('game_1.jpg', 'Lost Temple VR - Gameplay', '#d97706');
        $img3b = $generatePlaceholder('game_2.jpg', 'Lost Temple VR - Environment', '#b45309');
        ProductImage::create(['product_id' => $p3->id, 'image_path' => $img3a]);
        ProductImage::create(['product_id' => $p3->id, 'image_path' => $img3b]);
    }
}
