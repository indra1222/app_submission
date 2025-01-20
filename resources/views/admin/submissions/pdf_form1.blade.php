<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pengajuan</title>
    <style>
        body {
            font-family: Times New Roman, serif;
            line-height: 1.6;
            margin: 2cm;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .kop-surat h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .nomor-surat {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            margin: 20px 0;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
        .tandatangan {
            margin-top: 50px;
            text-align: right;
        }
        .stempel {
            margin-top: 80px;
            text-align: center;
            border: 2px solid #000;
            padding: 10px;
            width: 200px;
            float: right;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <h1>SURAT PENGAJUAN RESMI</h1>
        <h2>PEMERINTAH KABUPATEN/KOTA</h2>
        <p>Jalan Raya No. 123, Telepon: (021) 1234567</p>
    </div>

    <div class="nomor-surat">
        <p>Nomor: {{ sprintf('%04d', $submission->id) }}/PGJ/{{ date('m/Y') }}</p>
    </div>

    <div class="content">
        <div class="field">
            <span class="label">Nama Pemohon</span>
            <span>: {{ $submission->nama }}</span>
        </div>

        <div class="field">
            <span class="label">Alamat KTP</span>
            <span>: {{ $submission->alamat }}</span>
        </div>

        <div class="field">
            <span class="label">Tujuan Pengajuan</span>
            <span>: {{ $submission->tujuan }}</span>
        </div>

        <div class="field">
            <span class="label">Tanggal Pengajuan</span>
            <span>: {{ $submission->created_at->format('d F Y') }}</span>
        </div>
    </div>

    <div class="tandatangan">
        <p>{{ date('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p>Kepala Bagian</p>
    </div>

    <div class="stempel">
        Status: {{ strtoupper($submission->status) }}
    </div>
</body>
</html>