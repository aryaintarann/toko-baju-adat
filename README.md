# Toko Baju Adat - E-Commerce Platform

Toko Baju Adat adalah platform e-commerce yang dibangun menggunakan framework [Laravel 12](https://laravel.com/) untuk backend dan [Tailwind CSS v4](https://tailwindcss.com/) untuk styling frontend. Platform ini menyediakan berbagai fitur lengkap mulai dari katalog produk, keranjang belanja, proses checkout, integrasi pembayaran, hingga panel admin untuk mengelola toko.

## 🚀 Fitur Utama

### 🛍️ Public Storefront (Pengguna)
- **Katalog Produk:** Menampilkan daftar pakaian adat beserta rincian dan stok.
- **Keranjang Belanja:** Menambah, mengubah kuantitas, dan menghapus item dari keranjang.
- **Checkout:** Proses pemesanan dengan perhitungan total biaya secara dinamis.
- **Integrasi Kurir / Pengiriman:** Pencarian wilayah dan pengecekan tarif ongkos kirim secara otomatis via API.
- **Integrasi Pembayaran (Midtrans):** Pembayaran aman dan otomatis menggunakan gateway pembayaran Midtrans.
- **Lacak Pesanan:** Fitur untuk pelanggan mengecek status pesanan mereka secara real-time.
- **Sistem Refund / Pengembalian:** Memungkinkan pelanggan untuk mengajukan pengembalian dana berdasarkan kebijakan toko.

### 🛡️ Admin Dashboard (Pengelola)
- **Otentikasi Admin:** Sistem login terpisah khusus untuk pengelola sistem.
- **Manajemen Produk:** Tambah, edit, dan hapus data produk pakaian adat.
- **Manajemen Kategori:** Pengelompokan produk ke dalam berbagai kategori.
- **Manajemen Pesanan (Orders):** Melihat daftar pesanan masuk dan mengubah status pemesanan.
- **Manajemen Refund:** Meninjau dan memproses permintaan pengembalian dana dari pelanggan.

## 💻 Tech Stack
- **Backend:** PHP 8.2, Laravel 12.x
- **Frontend / Styling:** Vite, Tailwind CSS 4.x
- **Payment Gateway:** Midtrans (`midtrans/midtrans-php` package)
- **Database:** MySQL / SQLite / PostgreSQL (Disesuaikan di konfigurasi `.env`)

## 🛠️ Instalasi & Persiapan

Berikut adalah langkah-langkah untuk menjalankan aplikasi ini di environment lokal / pengembangan Anda:

1. **Clone repositori**
   ```bash
   git clone <url-repo-anda>
   cd toko-baju-adat
   ```

2. **Install dependensi PHP dan Node.js**
   ```bash
   composer install
   npm install
   ```

3. **Duplikat file konfigurasi environment**
   ```bash
   cp .env.example .env
   ```
   *Atau jika Anda menggunakan Windows CMD/PowerShell:*
   ```bash
   copy .env.example .env
   ```

4. **Konfigurasi file `.env`**
   Buka file `.env` di text editor pilihan Anda dan pastikan untuk mengisi / menyesuaikan kredensial berikut:
   - Koneksi Database (`DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
   - Kunci API Midtrans (seperti `MIDTRANS_SERVER_KEY`, dsb. jika ada)
   - Kunci API Kurir/Pengiriman

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi Database (dan Seeder jika ada)**
   ```bash
   php artisan migrate
   ```

7. **Kompilasi Asset Frontend**
   ```bash
   # Untuk development dengan hot-reload
   npm run dev

   # Atau untuk production build
   npm run build
   ```

8. **Jalankan Development Server**
   Pastikan membuka terminal baru atau biarkan proses Vite/npm berjalan, lalu jalankan:
   ```bash
   php artisan serve
   ```
   Selamat! Aplikasi sekarang dapat diakses melalui `http://localhost:8000`.

## 📂 Struktur Penting (Routing)
- `routes/web.php` : Mendefinisikan rute untuk halaman utama (public), checkout, sistem tracking, dan rute panel `/admin`.
- `routes/api.php` : API untuk Notifikasi callback Midtrans dan perhitungan biaya pengiriman/kurir.

## 🤝 Kontribusi
Jika ingin berkontribusi dalam pengembangan aplikasi ini:
1. Fork repository
2. Buat branch fitur Anda (`git checkout -b feature/FiturBaru`)
3. Commit perubahan Anda (`git commit -m 'Menambahkan FiturBaru'`)
4. Push ke branch referensi (`git push origin feature/FiturBaru`)
5. Buat Pull Request baru

## 📜 Lisensi
Lisensi aplikasi ini bersifat terbuka dan mengikuti pedoman [MIT license](https://opensource.org/licenses/MIT) sebagaimana direkomendasikan oleh Laravel.

---
