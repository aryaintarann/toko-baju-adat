<?php

$dirs = [
    'storage/app/public/categories',
    'storage/app/public/products',
];

foreach ($dirs as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
        echo "Created directory: $dir\n";
    }
}

$images = [
    'categories/pria.jpg',
    'categories/wanita.jpg',
    'categories/aksesoris.jpg',
    'categories/anak.jpg',
    'products/udeng-premium.jpg',
    'products/saput-endek.jpg',
    'products/kamben-songket.jpg',
    'products/safari-bali.jpg',
    'products/kebaya-brokat.jpg',
    'products/kamen-endek.jpg',
    'products/selendang-songket.jpg',
    'products/kebaya-kutubaru.jpg',
    'products/gelang-perak.jpg',
    'products/hiasan-sanggul.jpg',
    'products/kalung-etnik.jpg',
    'products/adat-anak-laki.jpg',
    'products/adat-anak-perempuan.jpg',
    'products/udeng-anak.jpg',
];

// 1x1 pixel grey JPEG
$base64Jpg = '/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAP//////////////////////////////////////////////////////////////////////////////////////wgALCAABAAEBAREA/8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAQABPxA=';

foreach ($images as $img) {
    $path = 'storage/app/public/' . $img;
    file_put_contents($path, base64_decode($base64Jpg));
    echo "Created image: $path\n";
}

echo "Done generating images.\n";
