# Preview Kaching Intelligence

Preview ini menguji apakah owner dapat menentukan tindakan harian dari layar pertama. Di PC, dua kartu prioritas tampil berdampingan. Di ponsel, kartu ditumpuk dengan tombol selebar kartu.

## Cara membuka

1. Buka [file HTML](previews/kaching-intelligence.html) di branch ini, lalu unduh lewat tombol **Download raw file**. Jika branch sudah di-checkout, buka file tersebut langsung dari folder `docs/previews`.
2. Buka file yang diunduh di browser. Untuk mengecek tampilan ponsel dari PC, gunakan mode perangkat di Developer Tools dengan lebar 390 px.
3. Coba **Periksa tutup shift** dan **Periksa HPP menu**. Gunakan tombol **Data contoh** untuk mencoba kondisi perlu tindakan, tidak ada temuan, dan data belum cukup.

## Fokus audit

- Apakah owner langsung melihat tindakan pertama, alasan prioritasnya, dan tombol yang harus ditekan?
- Apakah periode evaluasi dan keterbatasan HPP terlihat jelas sebelum owner menafsirkan skor?
- Apakah kondisi tanpa temuan dan kondisi data belum cukup mudah dibedakan?

## Batas preview

Halaman ini adalah prototipe HTML mandiri dengan data contoh. Tautan di modal menuju halaman BackOffice yang memerlukan login. Riwayat shift menampilkan semua selisih yang tercatat, sedangkan kartu kas merujuk pada selisih di atas Rp10.000. Katalog menunjukkan harga modal saat ini, sedangkan kartu HPP merujuk pada item transaksi historis. Integrasi nantinya perlu menyamakan sumber data, periode, dan outlet antara kartu dan rincian.
