@extends('backoffice::master')

@section('title', 'Raw Material Intelligence - Kaching Back Office')
@section('page_title', 'Raw Material Intelligence')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="{{ asset('vendor/backoffice/rmi/rmi.css') }}">
<div id="rmi-app">
    <svg class="rmi-symbols" aria-hidden="true"><defs>
        <symbol id="rmi-arrow" viewBox="0 0 24 24"><path d="M5 12h14m-6-6 6 6-6 6"/></symbol>
        <symbol id="rmi-trend" viewBox="0 0 24 24"><path d="m3 17 6-6 4 4 8-10m-6 0h6v6"/></symbol>
        <symbol id="rmi-leaf" viewBox="0 0 24 24"><path d="M20 4C8 2 2 9 6 15s14 3 14-11ZM4 21 16 9"/></symbol>
        <symbol id="rmi-info" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 11v6m0-10v1"/></symbol>
        <symbol id="rmi-calc" viewBox="0 0 24 24"><rect x="5" y="3" width="14" height="18" rx="3"/><path d="M8 7h8M8 12h1m3 0h1m3 0h.01M8 16h1m3 0h1m3 0h.01"/></symbol>
        <symbol id="rmi-news" viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h8M8 11h8m-8 4h4m-4 3h8"/></symbol>
        <symbol id="rmi-chat" viewBox="0 0 24 24"><path d="M20 11a8 8 0 0 1-8 8H8l-5 3 1.5-6A8 8 0 1 1 20 11Z"/><path d="M8 10h8m-8 4h5"/></symbol>
        <symbol id="rmi-external" viewBox="0 0 24 24"><path d="M14 3h7v7m0-7L10 14m0-9H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/></symbol>
        <symbol id="rmi-close" viewBox="0 0 24 24"><path d="m6 6 12 12M6 18 18 6"/></symbol>
        <symbol id="rmi-check" viewBox="0 0 24 24"><path d="m5 12 4 4L19 6"/></symbol>
    </defs></svg>

    <div class="rmi-heading">
        <div><div class="rmi-eyebrow">RAW MATERIAL INTELLIGENCE <span class="rmi-badge rmi-badge-amber">Demo interaktif</span></div>
            <h2>Bahan baku &amp; dampak biaya</h2>
            <p>Pahami sinyal pasar, uji perubahan harga, dan lihat dampaknya ke menu.</p>
        </div>
        <button class="rmi-button rmi-button-secondary" type="button" data-rmi-dialog="rmi-data-dialog"><svg><use href="#rmi-info"/></svg>Data &amp; Sumber</button>
    </div>

    <div class="rmi-tabbar" role="tablist" aria-label="Raw Material Intelligence">
        <button type="button" role="tab" id="rmi-tab-overview" aria-selected="true" aria-controls="rmi-panel-overview" tabindex="0" data-rmi-tab="overview"><svg><use href="#rmi-leaf"/></svg>Ringkasan</button>
        <button type="button" role="tab" id="rmi-tab-simulate" aria-selected="false" aria-controls="rmi-panel-simulate" tabindex="-1" data-rmi-tab="simulate"><svg><use href="#rmi-calc"/></svg>Simulasi</button>
        <button type="button" role="tab" id="rmi-tab-market" aria-selected="false" aria-controls="rmi-panel-market" tabindex="-1" data-rmi-tab="market"><svg><use href="#rmi-news"/></svg>Pasar</button>
    </div>
    <div class="rmi-demo-note"><svg><use href="#rmi-info"/></svg><p><strong>Ruang simulasi.</strong> Harga diisi manual, resep menggunakan data contoh. Data toko Anda tidak berubah.</p></div>

    <section id="rmi-panel-overview" role="tabpanel" aria-labelledby="rmi-tab-overview" tabindex="0">
        <div class="rmi-overview-grid">
            <article class="rmi-signal-card">
                <div class="rmi-signal-top"><span class="rmi-badge rmi-badge-dark"><span class="rmi-dot"></span>SINYAL PASAR</span><svg><use href="#rmi-trend"/></svg></div>
                <span class="rmi-signal-category">Tepung &amp; gandum</span>
                <h3>Perubahan pasokan gandum,<br>apa dampaknya ke menu Anda?</h3>
                <p>Berita dapat menjadi alasan untuk mengecek harga supplier. Uji asumsi Anda sebelum menilai dampaknya ke biaya resep.</p>
                <div class="rmi-signal-foot"><button type="button" class="rmi-button rmi-button-white" data-rmi-start="flour">Uji dampak tepung<svg><use href="#rmi-arrow"/></svg></button><span>Berita bukan bukti harga beli berubah</span></div>
                <div class="rmi-signal-source">Konteks dari arsip berita referensi · bukan pembaruan live</div>
            </article>
            <article class="rmi-card rmi-how-card">
                <span class="rmi-eyebrow">MULAI DARI SATU BAHAN</span><h3>Dari sinyal ke keputusan</h3>
                <ol class="rmi-steps"><li><span>1</span><div><strong>Tentukan asumsi harga</strong><p>Gunakan harga supplier atau input manual.</p></div></li><li><span>2</span><div><strong>Lihat dampak per porsi</strong><p>Telusuri takaran dan perubahan biaya resep.</p></div></li><li><span>3</span><div><strong>Siapkan pertanyaan ke Kachi</strong><p>Bawa hasil dan batasan data ke diskusi.</p></div></li></ol>
                <button type="button" class="rmi-text-button" data-rmi-go="simulate">Buka simulasi<svg><use href="#rmi-arrow"/></svg></button>
            </article>
        </div>

        <div class="rmi-section-heading"><div><h3>Bahan untuk diuji</h3><p>Pilih bahan dari resep contoh untuk mencoba alurnya.</p></div><span class="rmi-badge">Data Simulasi</span></div>
        <div class="rmi-ingredient-grid">
            <button type="button" class="rmi-card rmi-ingredient" data-rmi-start="flour"><span class="rmi-ingredient-icon rmi-blue"><svg><use href="#rmi-leaf"/></svg></span><span class="rmi-ingredient-name">Tepung terigu</span><span class="rmi-ingredient-meta">4 resep contoh · 1 belum lengkap</span><span class="rmi-card-rule"></span><span class="rmi-ingredient-bottom">Uji perubahan harga<svg><use href="#rmi-arrow"/></svg></span></button>
            <button type="button" class="rmi-card rmi-ingredient" data-rmi-start="chili"><span class="rmi-ingredient-icon rmi-rose"><svg><use href="#rmi-trend"/></svg></span><span class="rmi-ingredient-name">Cabai rawit merah</span><span class="rmi-ingredient-meta">2 resep contoh tersedia</span><span class="rmi-card-rule"></span><span class="rmi-ingredient-bottom">Uji perubahan harga<svg><use href="#rmi-arrow"/></svg></span></button>
            <button type="button" class="rmi-card rmi-ingredient" data-rmi-start="oil"><span class="rmi-ingredient-icon rmi-amber"><svg><use href="#rmi-calc"/></svg></span><span class="rmi-ingredient-name">Minyak goreng</span><span class="rmi-ingredient-meta">2 resep contoh · satuan liter</span><span class="rmi-card-rule"></span><span class="rmi-ingredient-bottom">Uji perubahan harga<svg><use href="#rmi-arrow"/></svg></span></button>
        </div>
        <div class="rmi-card rmi-reference-note"><span class="rmi-ingredient-icon rmi-blue"><svg><use href="#rmi-info"/></svg></span><div><h4>Harga pasar numerik belum tersedia</h4><p>Simulasi memakai harga yang Anda masukkan. Grafik dan prediksi akan memerlukan sumber harga yang dapat diverifikasi.</p></div><button type="button" class="rmi-text-button" data-rmi-dialog="rmi-data-dialog">Lihat sumber<svg><use href="#rmi-arrow"/></svg></button></div>
    </section>

    <section id="rmi-panel-simulate" role="tabpanel" aria-labelledby="rmi-tab-simulate" tabindex="0" hidden>
        <div class="rmi-section-heading rmi-simulation-heading"><div><h3>Bagaimana jika harga satu bahan berubah?</h3><p>Mulai dari harga dasar, lalu tentukan skenario Anda.</p></div><span class="rmi-badge rmi-badge-blue">1 bahan per simulasi</span></div>
        <div class="rmi-simulation-grid">
            <form id="rmi-form" class="rmi-card rmi-form" novalidate>
                <div class="rmi-form-title"><span class="rmi-step-icon">1</span><div><h3>Atur skenario harga</h3><p>Harga dan satuan berlaku untuk bahan terpilih.</p></div></div>
                <div id="rmi-story-context" class="rmi-callout" hidden><strong>Berawal dari berita</strong><p id="rmi-story-title"></p><small>Persentase perubahan tetap Anda tentukan sendiri.</small></div>
                <label for="rmi-ingredient">Bahan yang diuji <span class="rmi-badge">Data Simulasi</span></label>
                <select id="rmi-ingredient" name="ingredient"><option value="flour">Tepung terigu</option><option value="chili">Cabai rawit merah</option><option value="oil">Minyak goreng</option><option value="unmapped">Bahan lain · belum ada resep</option></select>
                <div class="rmi-field-meta"><span id="rmi-recipe-count">4 resep contoh terkait</span><span>Pemetaan contoh</span></div>
                <label for="rmi-base-price">Harga dasar <span class="rmi-badge rmi-badge-blue">Input Manual</span></label>
                <div class="rmi-price-input"><span>Rp</span><input type="number" id="rmi-base-price" name="basePrice" min="0.01" step="any" value="12000" inputmode="decimal" required aria-describedby="rmi-base-help rmi-form-error"><span class="rmi-input-unit">/ kg</span></div>
                <p class="rmi-field-help" id="rmi-base-help">Nilai awal adalah contoh. Ganti dengan harga supplier Anda.</p>
                <fieldset class="rmi-mode-field"><legend>Tentukan perubahan</legend><div class="rmi-segment"><label><input type="radio" name="rmi-mode" value="percent" checked><span>Persentase (%)</span></label><label><input type="radio" name="rmi-mode" value="price"><span>Harga baru (Rp)</span></label></div></fieldset>
                <label for="rmi-change" id="rmi-change-label">Perubahan harga (%)</label>
                <div class="rmi-price-input"><input type="number" id="rmi-change" name="change" step="any" value="10" inputmode="decimal" required aria-describedby="rmi-change-help rmi-form-error"><span id="rmi-change-suffix">%</span></div>
                <p class="rmi-field-help" id="rmi-change-help">Gunakan angka negatif untuk menguji penurunan harga.</p>
                <div class="rmi-price-preview"><span>Harga pada skenario</span><strong id="rmi-price-preview">Rp13.200 <small>/ kg</small></strong></div>
                <p id="rmi-form-error" class="rmi-error" role="alert" hidden></p>
                <button type="submit" class="rmi-button rmi-button-primary rmi-button-full"><svg><use href="#rmi-calc"/></svg>Hitung simulasi<svg><use href="#rmi-arrow"/></svg></button>
                <p class="rmi-form-safety"><svg><use href="#rmi-check"/></svg>Tidak mengubah harga, resep, atau stok toko.</p>
            </form>
            <aside class="rmi-simulation-aside">
                <article class="rmi-card rmi-assumptions"><div class="rmi-form-title"><span class="rmi-step-icon rmi-step-muted">2</span><h3>Yang digunakan dalam hitungan</h3></div><ul><li><svg><use href="#rmi-check"/></svg><span>Hanya harga bahan terpilih yang berubah.</span></li><li><svg><use href="#rmi-check"/></svg><span>Takaran, biaya bahan lain, dan harga jual tetap.</span></li><li><svg><use href="#rmi-check"/></svg><span>1 kg = 1.000 gram; 1 liter = 1.000 ml.</span></li></ul><div class="rmi-callout"><strong>Resep adalah data contoh</strong><p>Hasil ini belum membaca resep atau biaya aktual dari toko Anda.</p></div></article>
                <article class="rmi-card rmi-assumptions"><h4>Biaya resep, bukan seluruh biaya usaha</h4><p>Margin dihitung dari biaya bahan resep dan harga jual. Tenaga kerja, overhead, dan biaya operasional belum termasuk.</p><button class="rmi-text-button" type="button" data-rmi-dialog="rmi-data-dialog">Pahami dasar perhitungan<svg><use href="#rmi-arrow"/></svg></button></article>
            </aside>
        </div>

        <section id="rmi-results" class="rmi-results" aria-labelledby="rmi-results-title" hidden>
            <div class="rmi-section-heading"><div><h3 id="rmi-results-title" tabindex="-1">Dampak ke biaya &amp; margin resep</h3><p id="rmi-results-summary"></p></div><span class="rmi-badge rmi-badge-green">Estimasi Simulasi</span></div>
            <div id="rmi-result-metrics" class="rmi-result-metrics"></div>
            <div class="rmi-card rmi-result-table-wrap"><table class="rmi-result-table"><caption class="rmi-sr-only">Perbandingan biaya dan margin bahan per menu contoh</caption><thead><tr><th scope="col">Menu contoh</th><th scope="col">Biaya resep / porsi</th><th scope="col">Selisih / porsi</th><th scope="col">Margin berbasis resep</th><th scope="col">Rincian</th></tr></thead><tbody id="rmi-result-rows"></tbody></table></div>
            <div id="rmi-partial-note" class="rmi-callout rmi-callout-amber" hidden></div>
            <div class="rmi-result-basis"><svg><use href="#rmi-info"/></svg><p>Margin = (harga jual − biaya bahan resep) ÷ harga jual × 100%. Selisih margin dinyatakan dalam poin persentase. Nilai dihitung sebelum pembulatan.</p></div>
            <div class="rmi-kachi-banner"><div class="rmi-kachi-icon"><svg><use href="#rmi-chat"/></svg></div><div><h3>Bawa konteksnya ke Kachi</h3><p>Siapkan ringkasan skenario, hasil, dan batasan data untuk didiskusikan.</p></div><button type="button" class="rmi-button rmi-button-white" id="rmi-open-kachi">Bahas hasil dengan Kachi<svg><use href="#rmi-arrow"/></svg></button></div>
        </section>
        <div id="rmi-empty-results" class="rmi-card rmi-empty" hidden><svg><use href="#rmi-info"/></svg><h3>Belum ada resep terkait</h3><p>Harga skenario dapat dihitung, tetapi dampak menu memerlukan pemetaan bahan dan takaran resep. HPP dan margin belum tersedia.</p><button type="button" class="rmi-text-button" data-rmi-dialog="rmi-data-dialog">Lihat data yang diperlukan</button></div>
    </section>

    <section id="rmi-panel-market" role="tabpanel" aria-labelledby="rmi-tab-market" tabindex="0" hidden>
        <div class="rmi-section-heading"><div><h3>Konteks pasar untuk usaha Anda</h3><p>Gunakan berita sebagai sinyal untuk memeriksa harga supplier.</p></div><span class="rmi-badge">Arsip referensi</span></div>
        <div class="rmi-market-note"><svg><use href="#rmi-info"/></svg><p>Artikel diambil dari HTML referensi, bukan RSS live. Waktu publikasi dan kondisi pasar saat ini belum diverifikasi.</p></div>
        <div class="rmi-filters" role="group" aria-label="Filter berita"><button type="button" aria-pressed="true" data-rmi-filter="all">Semua berita</button><button type="button" aria-pressed="false" data-rmi-filter="flour">Tepung &amp; gandum</button><button type="button" aria-pressed="false" data-rmi-filter="food">Pangan umum</button><button type="button" aria-pressed="false" data-rmi-filter="chili">Cabai &amp; bumbu</button></div>
        <div id="rmi-news-list" class="rmi-news-grid"></div>
        <div id="rmi-news-empty" class="rmi-card rmi-empty" hidden><svg><use href="#rmi-news"/></svg><h3>Belum ada berita di kategori ini</h3><p>Arsip contoh belum memuat kategori tersebut. Anda tetap dapat menguji harga bahan secara manual.</p><button type="button" class="rmi-button rmi-button-secondary" data-rmi-start="chili">Buka simulasi cabai</button></div>
        <p class="rmi-market-footer">Sinyal berita tidak memastikan kenaikan harga bahan di outlet Anda.</p>
    </section>

    <dialog id="rmi-data-dialog" class="rmi-dialog" aria-labelledby="rmi-data-title"><div class="rmi-dialog-heading"><div><span class="rmi-eyebrow">TRANSPARANSI DATA</span><h3 id="rmi-data-title">Data &amp; Sumber</h3></div><button type="button" class="rmi-icon-button" data-rmi-close aria-label="Tutup Data dan Sumber"><svg><use href="#rmi-close"/></svg></button></div><div class="rmi-dialog-body">
        <p>Kenali asal setiap informasi sebelum menggunakan hasilnya.</p>
        <div class="rmi-source-item"><span class="rmi-badge rmi-badge-green">Data Aktual</span><h4>Data operasional yang berhasil dibaca</h4><p>Belum digunakan pada demo ini. Biaya tersimpan Core juga tidak otomatis merupakan histori pembelian.</p></div>
        <div class="rmi-source-item"><span class="rmi-badge">Referensi Harga Pasar</span><h4>Harga eksternal beserta sumber dan tanggal</h4><p>Belum tersedia pada preview. Berita tidak diperlakukan sebagai sumber harga numerik.</p></div>
        <div class="rmi-source-item"><span class="rmi-badge rmi-badge-blue">Input Manual</span><h4>Harga dasar dan asumsi dari Anda</h4><p>Nilai awal form adalah contoh yang dapat diganti. Harga tidak disimpan atau dikirim ke server.</p></div>
        <div class="rmi-source-item"><span class="rmi-badge">Data Simulasi</span><h4>Resep dan pemetaan bahan contoh</h4><p>Takaran, biaya bahan lain, dan harga jual bersifat sintetis. Resep tidak lengkap menghasilkan estimasi parsial.</p></div>
        <div class="rmi-source-item"><span class="rmi-badge rmi-badge-green">Estimasi Simulasi</span><h4>Hasil hitungan berdasarkan asumsi</h4><p>Biaya bahan resep tidak mencakup tenaga kerja, overhead, atau seluruh HPP produksi. Margin memerlukan harga jual yang valid.</p></div>
        <div class="rmi-callout"><strong>Kelengkapan contoh</strong><p>Tepung: 3 resep lengkap dan 1 parsial. Cabai: 2 lengkap. Minyak: 2 lengkap. Pemetaan ke toko aktual belum terhubung.</p></div>
    </div><div class="rmi-dialog-footer"><button type="button" class="rmi-button rmi-button-primary" data-rmi-close>Saya mengerti</button></div></dialog>

    <dialog id="rmi-detail-dialog" class="rmi-dialog" aria-labelledby="rmi-detail-title"><div class="rmi-dialog-heading"><div><span class="rmi-eyebrow">JEJAK PERHITUNGAN</span><h3 id="rmi-detail-title">Rincian biaya</h3></div><button type="button" class="rmi-icon-button" data-rmi-close aria-label="Tutup rincian biaya"><svg><use href="#rmi-close"/></svg></button></div><div id="rmi-detail-body" class="rmi-dialog-body"></div></dialog>

    <dialog id="rmi-kachi-dialog" class="rmi-dialog" aria-labelledby="rmi-kachi-title"><div class="rmi-dialog-heading"><div><span class="rmi-eyebrow">KACHI · KONTEKS SIMULASI</span><h3 id="rmi-kachi-title">Diskusi dimulai dari data yang jelas</h3></div><button type="button" class="rmi-icon-button" data-rmi-close aria-label="Tutup konteks Kachi"><svg><use href="#rmi-close"/></svg></button></div><div class="rmi-dialog-body"><span class="rmi-badge rmi-badge-amber">Ringkasan lokal · AI belum terhubung</span><p>Salin konteks ini untuk dibahas dengan Kachi. Preview tidak mengirim pertanyaan ke layanan AI.</p><pre id="rmi-kachi-context" class="rmi-context"></pre><div class="rmi-callout"><strong>Pertanyaan lanjutan</strong><p>“Menu mana yang perlu saya periksa lebih dulu, dan data apa yang belum lengkap untuk menilai margin usaha?”</p></div></div><div class="rmi-dialog-footer"><button type="button" class="rmi-button rmi-button-primary" id="rmi-copy-context">Salin konteks &amp; pertanyaan</button></div></dialog>
    <div id="rmi-toast" class="rmi-toast" role="status" aria-live="polite" hidden></div>
    <noscript><div class="rmi-callout rmi-callout-amber">Aktifkan JavaScript untuk menggunakan tab dan simulasi harga. Tidak ada data yang akan diubah.</div></noscript>
</div>
<script src="{{ asset('vendor/backoffice/rmi/rmi-simulator.js') }}" defer></script>
<script src="{{ asset('vendor/backoffice/rmi/rmi-page.js') }}" defer></script>
@endsection
