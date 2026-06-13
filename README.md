Aplikasi Blog Laravel
Nama dan NIM

Nama: Arum Nayla Farhani
NIM: 240605110005

DESKRIPSI SINGKAT
    Aplikasi Blog adalah website berbasis Laravel yang digunakan untuk mengelola dan menampilkan artikel blog. Sistem ini memiliki fitur manajemen artikel, kategori dan penulis sehingga memudahkan administrator dalam mengelola konten
    Fitur Utama
        Login Admin
        Kelola Penulis (Tambah, Edit, Hapus)
        Kelola Kategori Artikel
        Kelola Artikel
        Upload Gambar Artikel
        Halaman Publik Artikel
        Detail Artikel
        Relasi Artikel, Penulis, dan Kategori

Langkah-Langkah Menjalankan Aplikasi Secara Lokal
    1. Clone Repository
        git clone https://github.com/username/aplikasi-blog.git
        
    2. Masuk ke Folder Project
        cd aplikasi-blog
        
    3. Install Dependency Laravel
        composer install
        
    4. Salin File Environment
    cp .env.example .env

    Atau pada Windows:
        copy .env.example .env
        
        5. Generate Application Key
            php artisan key:generate
            
        6. Konfigurasi Database
            Buka file .env dan sesuaikan konfigurasi database:
            
            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=aplikasi_blog
            DB_USERNAME=root
            DB_PASSWORD=
            
        7. Jalankan Migrasi Database
            php artisan migrate
            
        8. Buat Storage Link
            php artisan storage:link
            
        9. Jalankan Server Laravel
                php artisan serve
        10. Akses Aplikasi
            Buka browser dan akses:
            
            http://127.0.0.1:8000

LINK YOUTUBE: https://youtu.be/CECC2n-7uOI?si=_Nzsq_1tFnhVidqr
