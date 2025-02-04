@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="bg-gradient-primary text-white position-relative overflow-hidden py-5 px-4 mb-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="display-6 fw-bold mb-2">Pedoman</h2>
                <p class="lead mb-0 opacity-75">Panduan dan informasi untuk penggunaan sistem</p>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row g-4">
            <!-- Panduan Penggunaan -->
            <div class="col-md-6">
                <div class="card h-100 border-0 rounded-4 shadow-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-book-open fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Panduan Penggunaan</h4>
                        <div class="accordion" id="guideAccordion">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#guide1">
                                        Cara Mengajukan Surat Tugas
                                    </button>
                                </h2>
                                <div id="guide1" class="accordion-collapse collapse show" data-bs-parent="#guideAccordion">
                                    <div class="accordion-body">
                                        <ol class="mb-0">
                                            <li>Klik tombol "Form Pengajuan Surat" pada halaman dashboard</li>
                                            <li>Isi formulir dengan lengkap dan benar</li>
                                            <li>Lampirkan dokumen pendukung jika diperlukan</li>
                                            <li>Klik tombol "Submit" untuk mengirim pengajuan</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#guide2">
                                        Cara Mengajukan SPPD
                                    </button>
                                </h2>
                                <div id="guide2" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                                    <div class="accordion-body">
                                        <ol class="mb-0">
                                            <li>Klik tombol "Permohonan SPPD" pada halaman dashboard</li>
                                            <li>Isi detail perjalanan dinas dengan lengkap</li>
                                            <li>Pastikan tanggal dan tujuan perjalanan sudah benar</li>
                                            <li>Submit formulir untuk memproses pengajuan</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#guide3">
                                        Cara Membuat Kuitansi
                                    </button>
                                </h2>
                                <div id="guide3" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
                                    <div class="accordion-body">
                                        <ol class="mb-0">
                                            <li>Klik tombol "Form Kuitansi" pada dashboard</li>
                                            <li>Isi informasi pembayaran dengan teliti</li>
                                            <li>Lampirkan bukti pendukung jika ada</li>
                                            <li>Review dan submit kuitansi</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ -->
            <div class="col-md-6">
                <div class="card h-100 border-0 rounded-4 shadow-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">FAQ</h4>
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        Berapa lama proses persetujuan surat?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Proses persetujuan surat biasanya memakan waktu 1-2 hari kerja, tergantung dari jenis surat dan ketersediaan pejabat yang berwenang.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        Bagaimana jika ada revisi dokumen?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Jika ada revisi, admin akan mengirimkan notifikasi melalui sistem. Anda dapat melakukan revisi dengan mengakses menu riwayat pengajuan.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        Dokumen apa saja yang perlu dilampirkan?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Dokumen yang diperlukan bervariasi tergantung jenis surat. Secara umum, siapkan scan KTP, surat pengantar, dan dokumen pendukung lainnya sesuai keperluan.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.accordion-button {
    background-color: rgba(78, 115, 223, 0.1);
    border: none;
    box-shadow: none;
}

.accordion-button:not(.collapsed) {
    background-color: rgba(78, 115, 223, 0.2);
    color: var(--primary);
    box-shadow: none;
}

.accordion-button::after {
    background-size: 1rem;
    transition: transform 0.3s ease;
}

.accordion-body {
    background-color: rgba(78, 115, 223, 0.05);
    border-radius: 0 0 0.5rem 0.5rem;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.icon-box {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
}

.card:hover .icon-box {
    transform: scale(1.1) rotate(5deg);
}
</style>
@endsection