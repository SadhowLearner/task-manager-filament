## Menjalankan Proyek Secara Lokal

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1. **Clone Repository**  
    Pastikan Anda memiliki Git terinstal di komputer Anda. Kemudian, buka terminal atau command prompt dan jalankan perintah berikut untuk meng-clone repository ini:
    ```bash
    git clone https://github.com/SadhowLearner/task-manager-filament
    ```

2. **Masuk ke Direktori Proyek**  
    Setelah proses clone selesai, pindah ke direktori proyek:
    ```bash
    cd task-manager-filament
    ```

3. **Instalasi Dependensi Backend**  
    Pastikan Anda memiliki Composer terinstal. Jalankan perintah berikut untuk menginstal semua dependensi backend:
    ```bash
    composer install
    ```

4. **Instalasi Dependensi Frontend**  
    Pastikan Anda memiliki Node.js dan npm terinstal. Jalankan perintah berikut untuk menginstal semua dependensi frontend:
    ```bash
    npm install
    ```

5. **Konfigurasi File `.env`**  
    Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    Kemudian, buka file `.env` dan sesuaikan konfigurasi seperti database, mail, dan lainnya sesuai kebutuhan Anda.

6. **Migrasi Database**  
    Pastikan database Anda sudah dikonfigurasi dengan benar di file `.env`. Lalu, jalankan migrasi database:
    ```bash
    php artisan migrate --seed
    ```

7. **Membuat Super Admin**  
    Gunakan perintah berikut untuk membuat super admin menggunakan Filament Shield:
    ```bash
    php artisan shield:super-admin
    ```

8. **Menjalankan Proyek**  
    Jalankan server pengembangan Laravel dengan perintah berikut:
    ```bash
    composer run dev
    ```

9. **Akses Aplikasi**  
    Buka browser Anda dan akses aplikasi melalui URL berikut:
    ```
    http://localhost:8000
    ```
