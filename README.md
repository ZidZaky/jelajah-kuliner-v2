# Jelajah Kuliner v2

<p align="center">
  <strong>A Better UI Version of Jelajah Kuliner - Discover Culinary Excellence</strong>
</p>

<p align="center">
  <a href="https://evftrya.com/jelajah-kuliner-v2/public/dashboard">
    <img src="https://img.shields.io/badge/Demo-Live_Preview-blue?style=for-the-badge&logo=google-chrome&logoColor=white" alt="Live Demo">
  </a>
</p>
---

## 📋 Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur Utama](#fitur-utama)
- [Stack Teknologi](#stack-teknologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Penggunaan](#penggunaan)
- [Struktur Proyek](#struktur-proyek)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)
- [Kontak](#kontak)

---

## 📌 Tentang Proyek

**Jelajah Kuliner v2** adalah aplikasi web yang dirancang dengan antarmuka pengguna yang lebih baik dan modern untuk membantu pengguna menjelajahi, menemukan, dan berbagi pengalaman kuliner di berbagai lokasi. Versi kedua ini merupakan peningkatan signifikan dari versi sebelumnya dengan fokus pada pengalaman pengguna yang superior dan antarmuka yang intuitif.

Proyek ini dikembangkan sebagai platform komprehensif untuk:
- 🍽️ Menemukan restoran dan tempat makan terbaik
- ⭐ Memberikan dan membaca ulasan kuliner
- 📍 Menemukan lokasi restoran dengan peta interaktif
- 👥 Berbagi rekomendasi dengan komunitas

---

## ✨ Fitur Utama

### 1. Antarmuka Pengguna Modern
- Desain responsif dan user-friendly
- Navigasi intuitif yang mudah digunakan
- Tema visual yang menarik dan konsisten

### 2. Katalog Restoran Lengkap
- Database restoran yang komprehensif
- Informasi detail termasuk menu, jam operasional, dan kontak
- Foto berkualitas tinggi dari menu dan suasana restoran

### 3. Sistem Ulasan & Rating
- Pengguna dapat memberikan rating dan ulasan
- Ulasan terverifikasi untuk memastikan kredibilitas
- Sistem rating berbasis bintang yang intuitif

### 4. Integrasi Peta
- Lokasi restoran pada peta interaktif
- Pencarian berdasarkan lokasi geografis
- Rute petunjuk arah langsung

### 5. Fitur Sosial
- Berbagi rekomendasi favorit
- Koleksi pribadi "Wishlist" restoran
- Komunitas pengguna yang aktif

---

## 🛠️ Stack Teknologi

| Kategori | Teknologi |
|----------|-----------|
| **Backend** | Laravel (Blade Template Engine) |
| **Frontend** | Blade, HTML5, CSS3 |
| **Database** | MySQL/PostgreSQL |
| **Server** | Apache/Nginx |
| **Version Control** | Git |

---

## 💻 Persyaratan Sistem

Sebelum memulai, pastikan Anda memiliki:
- PHP >= 8.0
- Composer (PHP Package Manager)
- Node.js >= 14.x (untuk asset compilation)
- MySQL >= 5.7 atau PostgreSQL >= 10
- Git untuk version control

---

## 🚀 Instalasi

### 1. Clone Repository
git clone https://github.com/ZidZaky/jelajah-kuliner-v2.git
cd jelajah-kuliner-v2

### 2. Install Dependencies
# Install PHP dependencies
composer install
# Install Node dependencies
npm install

### 3. Setup Environment
# Copy .env.example ke .env
cp .env.example .env
# Generate application key
php artisan key:generate

### 4. Konfigurasi Database
Buka file .env dan sesuaikan konfigurasi database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jelajah_kuliner
DB_USERNAME=root
DB_PASSWORD=

### 5. Migrasi Database
# Jalankan migrasi database
php artisan migrate
# (Opsional) Seed database dengan data contoh
php artisan db:seed

### 6. Build Assets
# Development
npm run dev
# Production
npm run build

### 7. Jalankan Server
# Menggunakan Laravel built-in server
php artisan serve
# Server akan berjalan di http://localhost:8000

---

## ⚙️ Konfigurasi

### File Konfigurasi Utama
- .env - Konfigurasi environment variables
- config/app.php - Pengaturan aplikasi
- config/database.php - Pengaturan database
- config/filesystems.php - Pengaturan storage file

### Pengaturan Rekomendasi (.env)
APP_NAME=Jelajah-Kuliner-v2
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jelajah_kuliner
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587

---

## 📖 Penggunaan

### Menjalankan Aplikasi
1. Start Development Server: php artisan serve
2. Akses Aplikasi: Buka browser dan navigasi ke http://localhost:8000
3. Login/Register: Buat akun pengguna baru untuk mengakses fitur lengkap

### Fitur Dasar
- Pencarian Restoran: Gunakan search bar untuk menemukan restoran
- Filter & Sort: Filter berdasarkan kategori, rating, atau lokasi
- Tulis Ulasan: Bagikan pengalaman kuliner Anda
- Tambah ke Wishlist: Simpan restoran favorit untuk nanti

---

## 📁 Struktur Proyek

jelajah-kuliner-v2/
├── app/                    # Logika aplikasi (Models, Controllers, Requests, Services)
├── routes/                 # Route definitions (web.php)
├── resources/              # Views (Blade templates), css, & js files
├── database/               # Database migrations & seeders
├── config/                 # Configuration files
├── public/                 # Public assets
├── .env.example            # Environment template
└── composer.json           # PHP dependencies

---

## 🤝 Kontribusi

Kami sangat menyambut kontribusi dari komunitas! Untuk berkontribusi:
1. Fork repository ini
2. Buat branch fitur baru (git checkout -b feature/AmazingFeature)
3. Commit perubahan Anda (git commit -m 'Add some AmazingFeature')
4. Push ke branch (git push origin feature/AmazingFeature)
5. Buka Pull Request

### Panduan Kontribusi
- Pastikan kode mengikuti style guide project
- Tulis test untuk fitur baru
- Update dokumentasi sesuai perubahan
- Gunakan commit messages yang deskriptif

---

## 📄 Lisensi
Proyek ini belum memiliki lisensi yang didefinisikan. Untuk informasi lebih lanjut tentang penggunaan dan distribusi kode, silakan hubungi pemilik repository.

---

## 📞 Kontak
- Developer: Zidan, Evi, Farhan, Dika
- Repository: ZidZaky/jelajah-kuliner-v2
- Issues: Report Bug atau Request Fitur

---

## 📝 Catatan Penting
- Pastikan semua dependencies ter-install dengan benar sebelum menjalankan aplikasi
- Database harus sudah ter-setup dan migrasi sudah dijalankan
- Untuk development, gunakan php artisan serve bukannya production server
- Update .env dengan konfigurasi lokal Anda sebelum running aplikasi
