# Playfair Cipher Pro Demo v2

## Cara Jalankan
1. Jalankan PHP built-in server:
   php -S localhost:8000
2. Buka browser ke http://localhost:8000

## Cara Demo
1. Klik Contoh Otomatis
2. Klik Enkripsi
3. Lihat hasil dan log muncul langsung di bawah hasil
4. Tekan Play Steps untuk animasi per langkah

TUGAS UTS KRIPTOGRAFI

Judul: Implementasi Gabungan Algoritma Playfair Cipher dan Caesar Cipher
Bahasa Pemrograman: PHP
Framework/Tampilan: Bootstrap 5
Pengembang: (isi dengan nama kamu)

🔐 1. DESKRIPSI PROYEK

Aplikasi ini merupakan implementasi dua algoritma klasik kriptografi, yaitu Playfair Cipher dan Caesar Cipher, yang dikombinasikan dalam satu proses.
Tujuan proyek ini adalah untuk memahami mekanisme enkripsi dan dekripsi berlapis serta perbedaan hasil dari setiap tahap.

Proses dilakukan dengan urutan:

Enkripsi:
Teks asli → Playfair Cipher → Caesar Cipher

Dekripsi:
Teks terenkripsi → Caesar Cipher (dekripsi) → Playfair Cipher (dekripsi)

Aplikasi ini dilengkapi dengan log proses algoritma untuk membantu memahami langkah-langkah enkripsi dan dekripsi secara mendetail.

⚙️ 2. STRUKTUR FILE PROYEK
TUGAS UTS KRIPTO/
│
├── index.php              # Halaman utama (input teks, key, shift, hasil & log)
├── action.php             # Proses utama enkripsi/dekripsi dan pengaturan log
├── playfair.php           # Implementasi algoritma Playfair & Caesar
├── clear.php              # Menghapus session dan reset halaman
│
├── assets/
│   ├── css/
│   │   └── style.css      # Styling tambahan (opsional)
│   └── js/
│       └── script.js      # Script tambahan (opsional)
│
└── README.txt             # Dokumentasi proyek (file ini)

🧩 3. PENJELASAN ALGORITMA
3.1. Playfair Cipher

Algoritma ini bekerja dengan pasangan huruf (bigram) menggunakan matriks 5x5.
Huruf “J” digantikan oleh “I”.
Aturan enkripsi:

Jika dua huruf sama → tambahkan huruf ‘X’ di antara mereka.

Jika huruf dalam baris yang sama → geser ke kanan.

Jika huruf dalam kolom yang sama → geser ke bawah.

Jika huruf berbeda baris & kolom → tukar kolom.

Aturan dekripsi kebalikan dari enkripsi:

Geser ke kiri (baris sama)

Geser ke atas (kolom sama)

Tukar kolom (jika berbeda baris & kolom)

Tambahan fitur:

Saat dekripsi, sistem otomatis menghapus huruf ‘X’ tambahan yang digunakan sebagai padding, agar hasil teks kembali alami.

3.2. Caesar Cipher

Caesar Cipher bekerja dengan pergeseran huruf (shift) sejauh nilai tertentu (0–25).
Contoh:

Teks:  HELLO
Shift: 3
Hasil: KHOOR


Jika mencapai akhir alfabet, huruf akan melingkar kembali ke A.
Dekripsi dilakukan dengan pergeseran balik sejauh (26 - shift).

🔁 4. URUTAN PROSES ENKRIPSI & DEKRIPSI
🔒 Enkripsi:

Input teks dan kunci Playfair serta nilai Shift Caesar.

Sistem melakukan enkripsi Playfair terlebih dahulu.

Hasil Playfair kemudian dienkripsi ulang dengan Caesar Cipher.

Hasil akhir ditampilkan beserta log dua algoritma.

🔓 Dekripsi:

Input teks terenkripsi, kunci Playfair, dan Shift Caesar yang sama.

Sistem melakukan dekripsi Caesar terlebih dahulu.

Hasilnya kemudian didekripsi kembali menggunakan Playfair Cipher.

Hasil akhir berupa teks asli (huruf X tambahan dihapus otomatis).

🖥️ 5. CARA MENJALANKAN PROYEK

Pastikan kamu sudah menginstal XAMPP atau Laragon.

Pindahkan folder TUGAS UTS KRIPTO ke dalam direktori:

C:\xampp\htdocs\


Jalankan Apache di XAMPP Control Panel.

Buka browser dan akses:

http://localhost/TUGAS%20UTS%20KRIPTO/


Isi form:

Teks: teks yang ingin dienkripsi atau didekripsi

Kunci Playfair: kata kunci untuk membuat matriks Playfair

Shift Caesar: jumlah pergeseran huruf (0–25)

Pilih tombol:

🔒 Enkripsi

🔓 Dekripsi

Hasil dan log akan muncul di bawah form.

📜 6. TAMPILAN OUTPUT

Aplikasi akan menampilkan:

Hasil teks akhir (enkripsi atau dekripsi)

Matriks 5x5 hasil pembentukan kunci Playfair

Langkah-langkah enkripsi setiap pasangan huruf

Proses Caesar Cipher (input, output, dan nilai shift)

Contoh hasil log:

Tahap 1: Playfair Cipher (Encrypt)
Pair: TH → UI
Pair: IS → KV
...

Tahap 2: Caesar Cipher (Shift: 3)
Input : UIKV...
Output: XLNY...

🧠 7. FITUR TAMBAHAN

✅ Otomatis menghapus huruf ‘X’ tambahan saat dekripsi
✅ Log proses dua algoritma
✅ Tombol “Copy” untuk menyalin hasil
✅ Desain responsif menggunakan Bootstrap
✅ Dukungan API JSON (responseType=json)

🧾 8. CATATAN PENTING

Gunakan huruf alfabet A–Z saja (tanpa angka atau simbol).

Huruf “J” otomatis diubah menjadi “I”.

Shift Caesar harus sama saat proses enkripsi dan dekripsi.

Jika hasil dekripsi berbeda, pastikan kunci Playfair dan shift sama seperti saat enkripsi.

✍️ 9. KONTAK / IDENTITAS

Isikan identitas kamu di sini:

Nama     : [Arya Putra Pratama]
NIM      : [312310022]
Kelas    : [TI.23.C1]
Mata Kuliah : Kriptografi
Dosen Pengampu : [Hemdani Rahendra Herlianto, S.Kom., M.T.I.]