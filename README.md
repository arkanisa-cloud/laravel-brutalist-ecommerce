# STS — The E-Commerce Vault System

[![Laravel Version](https://img.shields.io/badge/Laravel-13.x-red.svg)](https://laravel.com)
[![Alpine.js Version](https://img.shields.io/badge/Alpine.js-3.x-blue.svg)](https://alpinejs.dev)
[![TailwindCSS Version](https://img.shields.io/badge/TailwindCSS-3.x-38bdf8.svg)](https://tailwindcss.com)

STS adalah aplikasi web e-commerce berperforma tinggi yang berfokus pada pengalaman pengguna yang bersih serta alur data backend yang kokoh. Antarmuka pengguna (UI) mengadopsi gaya premium **Brutalist-Minimalism / Modern Vault Design**, yang memproses alur kerja utama dengan sangat cepat, tegas, dan elegan.

---

## 🚀 Fitur Unggulan Arsitektur & Rekayasa Kode

### 1. Strategi Caching Tingkat Lanjut (Enterprise Caching)
Untuk menghindari kendala koneksi timeout, menghindari batas limit API (`429 Too Many Requests`), serta menghilangkan ketergantungan penuh pada API pihak ketiga, aplikasi ini menerapkan **strict memory caching selama 30 hari** (`Cache::remember`) pada semua operasi data wilayah geografis. Pemanggilan dropdown alamat secara berulang setelah data tersimpan akan memangkas waktu respon secara drastis hingga **0ms**.

### 2. Trik Pemetaan Geografis Cerdas (Cakupan Alamat 4 Tingkat)
API logistik pihak ketiga membutuhkan **ID Kecamatan (District ID)** yang presisi untuk memproses kalkulasi ongkos kirim. Agar sistem tetap mendukung cakupan alamat lengkap 4 tingkat (Provinsi -> Kota -> Kecamatan -> Kelurahan) tanpa merusak atau membongkar skema database yang sudah ada:
- Kolom database `subdistrict_id` digunakan khusus untuk menyimpan **ID Kecamatan** secara langsung.
- Kolom teks `subdistrict` menyimpan string gabungan dengan format murni: `"Nama Kecamatan, Nama Kelurahan"` (Contoh: `"Jogonalan, Ngering"`).
- Alur kerja frontend secara otomatis memecah (*parsing*) struktur string ini secara dinamis pada saat mode edit alamat untuk mengisi kembali pilihan dropdown secara otomatis (*pre-populate*).

### 3. Keamanan Transaksi Database (Database Transaction Safety)
Proses finalisasi checkout dibungkus secara ketat di dalam isolasi transaksi database relasional (`DB::beginTransaction()`, `DB::commit()`, `DB::rollback()`). Hal ini menjamin integritas data secara penuh: jika pengurangan stok produk atau alokasi pembuatan order gagal di tengah jalan, seluruh status database akan dibatalkan otomatis (*rolled back*), mencegah terjadinya *error* stok hantu (stok berkurang tetapi order gagal).

### 4. Kontrol Metrik Berat Produk yang Ketat
Berat produk di dalam database dilacak menggunakan satuan **Gram murni berbasis Integer** (Contoh: `500` untuk 500 gram), bukan desimal kilogram (`0.5kg`). Pendekatan ini menghilangkan risiko pemotongan nilai (*truncation error*) menjadi `0` akibat kegagalan *loose casting* pada database, sehingga akurasi perhitungan kalkulasi ongkir ke API logistik tetap terjaga 100%.

---

## 🛠️ Tech Stack & Dependensi

- **Backend Framework:** Laravel 13 (PHP 8.2+)
- **Frontend Interactivity:** Alpine.js (Two-Way Data Binding)
- **Styling Architecture:** Tailwind CSS (Custom Vault Theme)
- **Database Engine:** MySQL / MariaDB
- **Logistics Engine:** Komerce / RajaOngkir API Mirror

---

## 📦 Alur Kerja & Fitur Utama

- [x] **Antarmuka Brutalist Vault:** Layout UI yang sangat responsif dan modern dengan memanfaatkan kontras tipografi yang tegas serta border minimalis yang bersih.
- [x] **Dropdown Alamat Bertingkat Otomatis:** Diurutkan berdasarkan alfabet (A-Z) secara *case-insensitive* dari sisi server menggunakan fungsi `usort` sebelum dikirim ke frontend.
- [x] **Kalkulator Ongkir Interaktif:** JavaScript Alpine.js melakukan *fetch background* data secara sinkron begitu kurir pengiriman dipilih oleh user.
- [x] **Navigasi Checkout Premium:** Validasi form secara *real-time* dengan integrasi manajemen alamat instan yang dilengkapi parameter memori pengalihan otomatis (`?redirect=checkout`).
- [x] **Unggah Bukti Pembayaran yang Aman:** Pembatasan file yang ketat (Maksimal 2MB, format MIME gambar valid) dengan pembaruan status transaksi otomatis lewat gerbang verifikasi admin (`pending status`).

---
