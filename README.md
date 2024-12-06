# Cinema App

### Disusun oleh: Aurel Izzety

### Pendahuluan
**Nama Aplikasi**: Cinema App  
**Platform**: Website  
**Deskripsi singkat**: Cinema App adalah sebuah platform sederhana untuk mengelola data pengguna, jadwal film, dan transaksi tiket. Aplikasi ini memungkinkan pengguna untuk memesan tiket dan memilih kursi yang tersedia dengan algoritma penjadwalan kursi.  
**Tujuan**: Memenuhi tugas praktik demonstrasi uji kompetensi skema analis program batch 3 2024.

---

### Fitur Aplikasi
- **Manajemen Pengguna**  
  CRUD data pengguna (Admin, User).

- **Manajemen Jadwal Film**  
  CRUD data jadwal film (judul, waktu tayang, harga tiket, durasi).

- **Transaksi Tiket**  
  Pemesanan tiket dengan algoritma penjadwalan kursi.

- **Validasi Kursi**  
  Kursi yang sudah dipesan tidak dapat dipilih kembali oleh pengguna lain.

---

### Perangkat Lunak yang Digunakan dalam Pengembangan Cinema App 
- **Backend**: Laravel versi 11.34.2  
- **Frontend**: Blade dan Tailwind CSS  
- **Database**: MySQL  
- **Framework Otentikasi**: Laravel Jetstream  
- **Bahasa Pemrograman**: PHP versi 8.2.0  
- **Server Lokal**: Laragon versi 6.0  
- **Editor Kode**: Visual Studio Code versi 1.95.2  
- **Pengujian API**: Postman versi 11.19 

---

### Rancangan Basis Data
Rancangan basis data untuk aplikasi ini telah diimplementasikan menggunakan **migration** Laravel. Detail migrasi database di direktori berikut:
`database/migrations/`

Berikut adalah deskripsi singkat mengenai tabel-tabel dalam basis data:
#### Tabel `users`
- **Tujuan**: Menyimpan data pengguna (Admin dan User).  
- **Atribut**: `id`, `name`, `email`, `password`, `role`, `timestamps`  
- **Relasi**:  
  - Relasi 1:M dengan tabel `transactions` melalui `user_id`.

#### Tabel `movies`
- **Tujuan**: Menyimpan data film.  
- **Atribut**: `id`, `title`, `description`, `duration`, `genre`, `timestamps`  
- **Relasi**:  
  - Relasi 1:M dengan tabel `schedules` melalui `movie_id`.

#### Tabel `schedules`
- **Tujuan**: Menyimpan jadwal penayangan film.  
- **Atribut**: `id`, `movie_id`, `date`, `time`, `price`, `timestamps`  
- **Relasi**:  
  - Relasi 1:M dengan tabel `seats` melalui `schedule_id`.  
  - Relasi 1:M dengan tabel `transactions` melalui `schedule_id`.

#### Tabel `seats`
- **Tujuan**: Menyimpan data kursi untuk setiap jadwal film.  
- **Atribut**: `id`, `schedule_id`, `seat_number`, `is_booked`, `timestamps`  
- **Relasi**:  
  - Relasi 1:1 dengan tabel `transactions` melalui `seat_id`.

#### Tabel `transactions`
- **Tujuan**: Menyimpan data transaksi tiket.  
- **Atribut**: `id`, `user_id`, `schedule_id`, `seat_id`, `total_price`, `status`, `timestamps`  
- **Relasi**:  
  - Relasi dengan tabel `users`, `schedules`, dan `seats`.

---

### Struktur Utama Proyek
```
cinema-app/
├── app/                
│   ├── Http/Controllers/	  # Controller aplikasi (logika permintaan dan respon)
│   ├── Models/			        # Model untuk interaksi dengan database
│   ├── Providers/		      # Penyedia layanan untuk konfigurasi aplikasi
│   ├── View/Components	    # Komponen Blade untuk UI
├── database/
│   ├── factories/		      # Factory untuk data dummy pengujian
│   ├── migrations/		      # Skrip migrasi untuk tabel database
│   ├── seeders/			      # Seeder untuk data dummy
├── public/			            # Aset publik (CSS, JS, gambar)
│   ├── images/			        # Gambar untuk aplikasi
├── resources/
│   ├── js/			            # Script frontend (Vue.js, JS)
│   ├── views/			        # Template Blade untuk UI
│   ├── views/movies		    # Folder Template Blade film
│   ├── views/schedules		  # Folder Template Blade jadwal
│   ├── views/seats		      # Folder Template Blade kursi
│   ├── views/transactions	# Folder Template Blade transaksi
│   ├── views/users		      # Folder Template Blade pengguna
├── routes/
│   ├── api.php			        # Routing API
│   ├── web.php			        # Routing web
├── tests/				          # Direktori pengujian
│   ├── Unit			          # Unit testing aplikasi
└── .env				            # Konfigurasi aplikasi
└── .env.testing			      # Konfigurasi pengujian
```

---

### Tampilkan Aplikasi
![](https://github.com/aurelizzety/cinema-app/blob/main/app-view.png)

---

### Cara Menjalankan Aplikasi
1. **Clone repository ini**:
```bash
git clone https://github.com/aurelizzety/cinema-app.git
```

2. **Masuk ke direktori aplikasi**:
```bash
cd cinema-app
```

3. **Instal dependensi aplikasi**:
```bash
composer install
```

4. **Buat file .env**:
```bash
cp .env.example .env
```

5. **Jalankan perintah untuk melakukan generate key**:
```bash
php artisan key:generate
```

6. **Migrasi database**:
```bash
php artisan migrate
```

7. **Install npm dependency**:
```bash
npm install
```

8. **Jalankan server**:
```bash
php artisan serve
```
Aplikasi akan berjalan pada `http://localhost:8000`.

9. **Pengujian Unit**:
```bash
php artisan test tests/Unit
```