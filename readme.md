# Tokobarang

Tokobarang adalah aplikasi berbasis web yang dibangun dengan PHP untuk mengelola transaksi dan produk di toko online. Aplikasi ini memungkinkan pengguna untuk menambahkan, melihat, dan mengelola transaksi serta produk dengan fitur pencarian dan filter berdasarkan kode transaksi atau nama pelanggan. Juga dilengkapi dengan fitur untuk menghasilkan laporan penjualan.

## Fitur
- **Login dan Register Pengguna** 
- **CRUD Barang** (Tambah, Edit, Hapus, Lihat)
  - Cari berdasarkan Kode atau Nama Barang
  - Filter berdasarkan Kategori
- **CRUD Pelanggan** (Tambah, Edit, Hapus, Lihat)
- **CRUD Transaksi** (Tambah, Edit, Hapus, Lihat)
  - Cari berdasarkan Kode atau Nama Pelanggan
  - Filter berdasarkan Periode Bulan
- **Hasilkan Laporan Penjualan**


## Instalasi
1. Clone repository:
    ```bash
    git clone https://github.com/muhammadfaiz19/tokobarang.git
    ```
2. Masuk ke direktori proyek:
    ```bash
    cd tokobarang
    ```
3. Jalankan `composer install` untuk menginstal dependensi yang diperlukan.
    ```bash
    composer install
    ```
4. Salin file `.env.example` menjadi `.env` dan konfigurasi koneksi database.
5. Jalankan aplikasi pada server lokal seperti XAMPP atau Laragon.

## Penggunaan
1. Jalankan server dan buka aplikasi di browser.
2. Gunakan antarmuka untuk mengelola transaksi dan produk.
3. Cetak laporan penjualan menggunakan tombol yang tersedia di dashboard.