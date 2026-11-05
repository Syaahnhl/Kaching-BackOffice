# Preview Kaching Intelligence

Preview v3 ini menguji apakah owner dapat menentukan tindakan harian dari layar pertama. Di ponsel, kedua temuan tampil dalam satu daftar ringkas dan rincian terbuka di bawah baris yang dipilih. Di desktop, daftar dan rincian terpilih tampil berdampingan. Latar slate, ikon kalender dan kas, serta aksen status mengikuti referensi visual Kaching.

## Cara membuka

1. Buka [file HTML](previews/kaching-intelligence.html) di branch ini, lalu unduh lewat tombol **Download raw file**. Jika branch sudah di-checkout, buka file tersebut langsung dari folder `docs/previews`.
2. Buka file yang diunduh di browser. Untuk mengecek tampilan ponsel dari PC, gunakan mode perangkat di Developer Tools pada ukuran 320 × 640 dan 390 × 844. Untuk desktop, gunakan ukuran 1440 × 900.
3. Pilih **Selisih kas** dan **HPP transaksi belum lengkap**. Di ponsel, ketuk baris yang sama lagi untuk menutup rincian. Di desktop, pilihan baru mengganti isi panel kanan.
4. Buka **Kesiapan pembukuan** untuk melihat skor kelengkapan, bukti transaksi dan tautan PDF. Di **Analisis lanjutan**, buka **Harga acuan bahan baku** untuk melihat cuplikan referensi.
5. Buka **Bantuan Kachi**, pilih topik, lalu coba salin pertanyaan. Gunakan **Skenario preview** di bagian bawah untuk mencoba tiga kondisi data.

## Fokus audit

- Apakah kedua temuan beserta angkanya terlihat sebelum menggulir di ponsel?
- Apakah owner memahami rincian yang terbuka dan halaman yang akan dituju dari tautan di dalamnya?
- Apakah periode evaluasi dan keterbatasan HPP terlihat jelas sebelum owner menafsirkan skor?
- Apakah kondisi tanpa temuan dan kondisi data belum cukup mudah dibedakan?

## Batas preview

Halaman ini adalah prototipe HTML mandiri dengan data contoh. Tautan di panel rincian menuju halaman BackOffice yang memerlukan login. Riwayat shift menampilkan semua selisih yang tercatat, sedangkan temuan kas merujuk pada selisih di atas Rp10.000. Katalog menunjukkan harga modal saat ini, sedangkan temuan HPP merujuk pada item transaksi historis. Integrasi nantinya perlu menyamakan sumber data, periode, dan outlet antara temuan dan rincian.
