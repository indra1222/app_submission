<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Surat Tugas</title>
    <style>
        @page {
            size: A4;
            margin: 2.5cm;
        }
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.4;
            max-width: 210mm;
            margin: 0 auto;
            padding: 0;
        }
        .kop {
            text-align: center;
            margin-bottom: 1cm;
        }
        .logo-bps {
            width: 45px;
            height: auto;
            margin: 0 auto 10px;
            display: block;
        }
        .kop h1 {
            font-size: 13pt;
            margin: 5px 0;
        }
        .surat-tugas {
            text-decoration: underline;
            font-weight: bold;
            margin: 10px 0 5px;
        }
        .section {
            margin-bottom: 0.5cm;
            display: flex;
            gap: 5px;
        }
        .label {
            width: 90px;
            flex-shrink: 0;
        }
        .content {
            flex: 1;
            text-align: justify;
        }
        .mengingat ol {
            margin: 0;
            padding-left: 20px;
        }
        .mengingat li {
            margin-bottom: 2px;
            font-size: 11pt;
        }
        .perintah {
            text-align: center;
            font-weight: bold;
            margin: 0.8cm 0;
        }
        .data-pegawai {
            margin-left: 95px;
        }
        .pegawai-row {
            margin-bottom: 3px;
        }
        .pegawai-label {
            display: inline-block;
            width: 70px;
        }
        .ttd {
            float: right;
            text-align: center;
            margin-top: 1cm;
        }
        .ttd p {
            margin: 3px 0;
        }
        .ttd .nama {
            margin-top: 1.5cm;
        }
    </style>
</head>
<body>
    <div class="kop">
        <img src="/api/placeholder/45/45" alt="Logo BPS" class="logo-bps">
        <h1>BADAN PUSAT STATISTIK KABUPATEN GARUT</h1>
        <h2 class="surat-tugas">SURAT TUGAS</h2>
        <p>Nomor: B-0736/32051/VS.300/2024</p>
    </div>

    <div class="section">
        <span class="label">Menimbang:</span>
        <span class="content">Bahwa untuk kepentingan tugas dalam kegiatan yang dilakukan BPS Kabupaten Garut dipandang perlu untuk memberikan surat tugas.</span>
    </div>

    <div class="section mengingat">
        <span class="label">Mengingat:</span>
        <div class="content">
            <ol>
                <li>Undang-Undang No. 16 Tahun 1997 Tentang Statistik;</li>
                <li>Peraturan Pemerintah RI No. 51 Tahun 1999, Tentang Penyelenggaraan Statistik;</li>
                <li>Keputusan Presiden RI No. 166 Tahun 2000;</li>
                <li>Peraturan Pemerintah No. 86 Tahun 2007 tentang Badan Pusat Statistik;</li>
                <li>Peraturan Kepala Badan Pusat Statistik Nomor 116 Tahun 2014 tentang Organisasi dan Tata Kerja Badan Pusat Statistik;</li>
                <li>Peraturan Badan Pusat Statistik No. 8 Tahun 2020 tentang Organisasi dan Tata Kerja Badan Pusat Statistik Provinsi dan Badan Pusat Statistik Kabupaten/Kota;</li>
            </ol>
        </div>
    </div>

    <div class="perintah">MEMBERI PERINTAH</div>

    <div class="section">
        <span class="label">Kepada:</span>
        <div class="data-pegawai">
            <div class="pegawai-row">
                <span class="pegawai-label">Nama</span>: {{$submission->nama}}
            </div>
            <div class="pegawai-row">
                <span class="pegawai-label">NIP/NIK</span>: {{json_decode($submission->kepada)[0]->nip_nik}}
            </div>
            <div class="pegawai-row">
                <span class="pegawai-label">Jabatan</span>: {{json_decode($submission->kepada)[0]->jabatan}}
            </div>
        </div>
    </div>

    <div class="section">
        <span class="label">Untuk:</span>
        <span class="content">{{$submission->untuk}}</span>
    </div>

    <div class="section">
        <span class="label">Jangka Waktu:</span>
        <span class="content">{{$submission->jangka_waktu}}</span>
    </div>

    <div class="ttd">
        <p>Garut, {{date('d F Y')}}</p>
        <p>Kepala,</p>
        <p class="nama">Nevi Hendri, S.Si, M.M.</p>
        <p>NIP. 19721130 199203 1 001</p>
    </div>
</body>
</html>