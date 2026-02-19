<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tokobajuadat.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Pakaian Pria',
                'slug' => 'pakaian-pria',
                'description' => 'Koleksi baju adat Bali untuk pria, termasuk udeng, saput, dan kamben.',
                'image' => 'categories/pria.jpg',
            ],
            [
                'name' => 'Pakaian Wanita',
                'slug' => 'pakaian-wanita',
                'description' => 'Koleksi baju adat Bali untuk wanita, termasuk kebaya, selendang, dan kamen.',
                'image' => 'categories/wanita.jpg',
            ],
            [
                'name' => 'Aksesoris',
                'slug' => 'aksesoris',
                'description' => 'Aksesoris pelengkap busana adat Bali seperti gelang, kalung, dan hiasan rambut.',
                'image' => 'categories/aksesoris.jpg',
            ],
            [
                'name' => 'Pakaian Anak',
                'slug' => 'pakaian-anak',
                'description' => 'Koleksi baju adat Bali untuk anak-anak, laki-laki dan perempuan.',
                'image' => 'categories/anak.jpg',
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create products
        $products = [
            // Pakaian Pria
            [
                'category_id' => 1,
                'name' => 'Udeng Bali Premium',
                'slug' => 'udeng-bali-premium',
                'description' => 'Udeng Bali premium dengan bahan songket berkualitas tinggi. Cocok digunakan untuk upacara adat, pernikahan, dan acara keagamaan. Tersedia dalam berbagai motif tradisional khas Bali yang elegan dan bermakna spiritual.',
                'price' => 185000,
                'stock' => 50,
                'image' => 'products/udeng-premium.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Saput Endek Pria',
                'slug' => 'saput-endek-pria',
                'description' => 'Saput dengan bahan endek Bali asli tenunan tangan. Memiliki motif khas yang menggambarkan keindahan budaya Bali. Nyaman dipakai dan cocok untuk berbagai acara adat.',
                'price' => 275000,
                'stock' => 35,
                'image' => 'products/saput-endek.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Kamben Pria Songket',
                'slug' => 'kamben-pria-songket',
                'description' => 'Kamben pria dengan bahan songket Bali premium. Tenunan halus dengan benang emas yang memberikan kesan mewah dan elegan. Cocok untuk upacara besar.',
                'price' => 450000,
                'stock' => 20,
                'image' => 'products/kamben-songket.jpg',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Baju Safari Adat Bali',
                'slug' => 'baju-safari-adat-bali',
                'description' => 'Baju safari khas adat Bali berwarna putih bersih. Dibuat dari bahan katun premium yang adem dan nyaman. Jahitan rapi dengan detail bordiran motif Bali.',
                'price' => 225000,
                'stock' => 40,
                'image' => 'products/safari-bali.jpg',
                'is_featured' => false,
                'is_active' => true,
            ],

            // Pakaian Wanita
            [
                'category_id' => 2,
                'name' => 'Kebaya Bali Brokat',
                'slug' => 'kebaya-bali-brokat',
                'description' => 'Kebaya Bali cantik dengan bahan brokat premium import. Desain modern namun tetap mempertahankan keanggunan tradisional Bali. Tersedia dalam berbagai warna pastel yang menawan.',
                'price' => 350000,
                'stock' => 30,
                'image' => 'products/kebaya-brokat.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Kamen Endek Wanita',
                'slug' => 'kamen-endek-wanita',
                'description' => 'Kamen endek Bali untuk wanita dengan motif bunga khas Bali. Tenunan tangan dengan warna-warna cerah yang indah. Bahan lembut dan nyaman dipakai seharian.',
                'price' => 325000,
                'stock' => 25,
                'image' => 'products/kamen-endek.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Selendang Songket Bali',
                'slug' => 'selendang-songket-bali',
                'description' => 'Selendang songket Bali dengan benang emas yang berkilauan. Pelengkap sempurna untuk kebaya adat. Motif tradisional yang sarat makna budaya dan spiritual.',
                'price' => 195000,
                'stock' => 45,
                'image' => 'products/selendang-songket.jpg',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Kebaya Kutubaru Bali',
                'slug' => 'kebaya-kutubaru-bali',
                'description' => 'Kebaya model kutubaru dengan sentuhan Bali. Perpaduan elegan antara gaya Jawa dan Bali. Dibuat dari bahan sutra premium dengan bordir tangan yang detail.',
                'price' => 425000,
                'stock' => 15,
                'image' => 'products/kebaya-kutubaru.jpg',
                'is_featured' => false,
                'is_active' => true,
            ],

            // Aksesoris
            [
                'category_id' => 3,
                'name' => 'Gelang Perak Bali',
                'slug' => 'gelang-perak-bali',
                'description' => 'Gelang perak sterling buatan tangan pengrajin Celuk, Bali. Desain ukiran tradisional yang rumit dan detail. Cocok sebagai pelengkap busana adat maupun casual.',
                'price' => 165000,
                'stock' => 60,
                'image' => 'products/gelang-perak.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Hiasan Sanggul Bali',
                'slug' => 'hiasan-sanggul-bali',
                'description' => 'Set hiasan sanggul untuk melengkapi tata rias adat Bali. Terdiri dari bunga emas, tusuk konde, dan ornamen tradisional. Memberikan sentuhan sempurna pada penampilan.',
                'price' => 145000,
                'stock' => 40,
                'image' => 'products/hiasan-sanggul.jpg',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Kalung Etnik Bali',
                'slug' => 'kalung-etnik-bali',
                'description' => 'Kalung etnik Bali dengan perpaduan batu alam dan perak. Dibuat oleh pengrajin lokal dengan teknik tradisional. Setiap kalung memiliki keunikan tersendiri.',
                'price' => 210000,
                'stock' => 35,
                'image' => 'products/kalung-etnik.jpg',
                'is_featured' => false,
                'is_active' => true,
            ],

            // Pakaian Anak
            [
                'category_id' => 4,
                'name' => 'Set Adat Bali Anak Laki',
                'slug' => 'set-adat-bali-anak-laki',
                'description' => 'Set lengkap pakaian adat Bali untuk anak laki-laki. Termasuk udeng mini, baju, dan kamben. Bahan nyaman dan aman untuk anak-anak. Tersedia ukuran 2-10 tahun.',
                'price' => 275000,
                'stock' => 25,
                'image' => 'products/adat-anak-laki.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Set Adat Bali Anak Perempuan',
                'slug' => 'set-adat-bali-anak-perempuan',
                'description' => 'Set lengkap pakaian adat Bali untuk anak perempuan. Termasuk kebaya mini, kamen, dan selendang. Desain lucu dan bahan lembut. Tersedia ukuran 2-10 tahun.',
                'price' => 295000,
                'stock' => 25,
                'image' => 'products/adat-anak-perempuan.jpg',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Udeng Anak Motif Batuan',
                'slug' => 'udeng-anak-motif-batuan',
                'description' => 'Udeng mini untuk anak dengan motif lukisan Batuan yang unik. Ukuran disesuaikan untuk kepala anak-anak. Bahan ringan dan nyaman dipakai.',
                'price' => 85000,
                'stock' => 50,
                'image' => 'products/udeng-anak.jpg',
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
