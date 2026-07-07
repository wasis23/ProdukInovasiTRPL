# AI Development Blueprint: Website Katalog Produk D4 TRPL (v2)

Dokumen ini berfungsi sebagai instruksi utama untuk membangun website katalog produk program studi D4 Teknologi Rekayasa Perangkat Lunak menggunakan Laravel. Fokus utama adalah performa yang cepat (fast-loading), UI profesional, interaktivitas yang mulus, serta Dashboard Admin yang fungsional untuk manajemen data.

---

## 1. TECH STACK & ARSITEKTUR
* **Backend:** Laravel 11+ (PHP 8.2+)
* **Frontend Publik:** Tailwind CSS (via Vite) + Alpine.js (Ringan, cepat, cocok untuk pop-up & slider tanpa framework berat).
* **Frontend Admin Panel:** Laravel Filament v3 ATAU Custom Tailwind Components (Sangat direkomendasikan menggunakan Filament v3 untuk performa cepat, keamanan tinggi, dan tampilan admin standar industri yang instan).
* **Database:** MySQL / MariaDB.
* **Asset Management:** Gambar produk di-upload ke local storage (dengan optimasi/kompresi), sedangkan **Video sepenuhnya menggunakan Link YouTube Embed** untuk menghemat bandwidth server dan mempercepat loading.

---

## 2. STRUKTUR DATABASE (MIGRATION)

### Tabel: `categories`
* `id` (Primary Key)
* `name` (Varchar: Website, IoT, Games)
* `slug` (Varchar, unique)

### Tabel: `products`
* `id` (Primary Key)
* `category_id` (Foreign Key ke `categories`, cascade)
* `title` (Varchar)
* `slug` (Varchar, unique)
* `description` (Text)
* `youtube_url` (Varchar) -> *Menyimpan link video YouTube (e.g., https://www.youtube.com/watch?v=... atau link embed)*
* `live_preview_url` (Varchar, nullable) -> *Khusus produk Website*
* `created_at` & `updated_at`

### Tabel: `product_images` (Untuk Galeri Slider di IoT & Games)
* `id` (Primary Key)
* `product_id` (Foreign Key ke `products`, cascade)
* `image_path` (Varchar)

---

## 3. STRUKTUR HALAMAN & UI/UX

### A. Halaman Publik (Katalog Utama)
* **Hero Section:** Judul profesional dengan gaya akademik modern (e.g., "Showcase Inovasi Teknologi Rekayasa Perangkat Lunak D4 TRPL").
* **Filter Kategori Dinamis:** Tab filter (**Semua**, **Website**, **IoT**, **Games**) dikendalikan oleh Alpine.js untuk instant filtering tanpa reload halaman.
* **Grid Card Produk:** Card minimalis premium dengan lazy-loaded thumbnail. Ketika diklik, akan memicu **Pop-up Modal (Alpine.js)**.

#### Logika Konten Pop-up Dinamis:
1. **Kategori Website:** Menampilkan deskripsi, responsif YouTube Embed Player, dan tombol aksen "Live Preview" (buka tab baru ke demo web).
2. **Kategori IoT & Games:** Menampilkan deskripsi, responsif YouTube Embed Player di bagian atas/samping, dan **Image Slider** (navigasi panah + dots indicator via Alpine.js) di bawahnya untuk galeri hardware/screenshot game.

### B. Halaman Dashboard Admin (Profesional & Secure)
Halaman admin dilindungi oleh auth middleware bawaan Laravel (`Auth`). Desain menggunakan tema *Dark/Light mode* berbasis Tailwind yang bersih.

* **Dashboard Overview:** Stat card sederhana (Total Produk, Total Website, Total IoT, Total Games).
* **Manajemen Kategori:**
  * Tabel data kategori dengan fitur Tambah, Edit, dan Hapus.
  * Auto-generate `slug` dari nama kategori menggunakan JavaScript/Livewire.
* **Manajemen Produk (CRUD):**
  * **Form Tambah/Edit Produk:**
    * Dropdown pilihan Kategori.
    * Input Ringkas: Judul, Deskripsi (Rich Text/Textarea), Link YouTube (`youtube_url`), dan Link Live Preview (`live_preview_url` - opsional).
    * Multi-image Upload: Drag-and-drop zone untuk mengunggah beberapa gambar sekaligus (khusus slider IoT/Games).
  * **Datatable Produk:** Lengkap dengan fitur pencarian (*search bar*), filter berdasarkan kategori, dan pagination cepat.

---

## 4. FITUR TAMBAHAN UNTUK NILAI PLUS (ADVANCED FEATURES)
1. **YouTube URL Parser:** Sistem otomatis mengubah link YouTube biasa (share link/browser link) menjadi format `embed` di sisi backend/blade agar aman dipasang di iframe.
2. **Spatie Media Library (Opsional):** Untuk manajemen gambar produk yang lebih rapi, otomatis membuat ukuran thumbnail yang ringan (responsive images).
3. **SEO Friendly:** Meta tags dinamis pada halaman detail/pop-up (jika di-index) memanfaatkan field `slug`.

---

## 5. INSTRUKSI IMPLEMENTASI UNTUK AI

### Langkah 1: Setup Models & Database
Buat model `Category`, `Product`, dan `ProductImage` lengkap dengan relasi `hasMany` dan `belongsTo`. Gunakan Eager Loading (`with(['category', 'images'])`) pada query controller utama untuk mencegah *N+1 query problem* demi performa maksimal.

### Langkah 2: Pembuatan Admin Panel (Pilih Salah Satu Instruksi)
* *Opsi A (Rekomendasi Cepat):* "Install Laravel Filament v3, buat Resource untuk Category dan Product lengkap dengan Form Component Select, TextInput, dan FileUpload (multiple)."
* *Opsi B (Custom Blade):* "Buat Route Group `/admin` dengan middleware `auth`. Buat layout admin professional menggunakan Tailwind, manfaatkan Tailwind Components untuk form dan datatable."

### Langkah 3: Optimasi Kecepatan (Fast-Loading)
* Gunakan atribut `loading="lazy"` pada slider gambar.
* Gunakan Alpine.js `@click` untuk memuat iframe YouTube secara dinamis. **Jangan load iframe YouTube sebelum modal diklik** agar *Initial Page Load Speed* website utama tetap berada di nilai optimal (Green Score Lighthouse).

---

## 6. DESIGN SYSTEM & PALETTE
* **Primary / Sidebar Admin:** Slate Dark (`bg-slate-900`) untuk kesan kokoh dan premium.
* **Accent / CTA:** Emerald Green (`bg-emerald-600`) atau Indigo Blue (`bg-indigo-600`) untuk tombol aksi utama.
* **Typography:** Inter atau Sans-Serif standar yang bersih dengan line-spacing `leading-relaxed`.
