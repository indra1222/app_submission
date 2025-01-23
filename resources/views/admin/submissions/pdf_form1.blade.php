<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Tugas</title>
    <style>
    body {
        font-family: Times New Roman, serif;
        margin: 2cm;
        line-height: 1.6;
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

    .kop-surat p {
        margin: 0;
        font-size: 14px;
    }

    .nomor-surat {
        text-align: right;
        margin-bottom: 20px;
    }

    .section {
        margin-bottom: 20px;
    }

    .label {
        font-weight: bold;
    }

    .tandatangan {
        margin-top: 50px;
        text-align: right;
    }

    .info {
        margin-top: 10px;
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="kop-surat">
        <h1>BADAN PUSAT STATISTIK KABUPATEN/KOTA</h1>
        <p>Jalan Raya No. 123, Telepon: (021) 1234567</p>
    </div>

    <div class="nomor-surat">
        <p>Nomor: {{ sprintf('%04d', $submission->id) }}/TGS/{{ date('m/Y') }}</p>
    </div>

    <div class="section">
        <p class="label">Menimbang:</p>
        <p>{{ $submission->menimbang }}</p>
    </div>

    <div class="section">
        <p class="label">Kepada:</p>
        <ul>
            @foreach (json_decode($submission->kepada, true) as $item)
            <li>
                <p>Nama: {{ $item['nama'] }}</p>
                <p>NIP/NIK: {{ $item['nip_nik'] }}</p>
                <p>Jabatan: {{ $item['jabatan'] }}</p>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="section">
        <p class="label">Untuk:</p>
        <p>{{ $submission->untuk }}</p>
    </div>

    <div class="section">
        <p class="label">Jangka Waktu:</p>
        <p>{{ $submission->jangka_waktu }}</p>
    </div>

    <div class="tandatangan">
        <p>Garut, {{ date('d F Y') }}</p>
        <p>Kepala,</p>
        <br><br><br>
        <p>{{ $submission->kepala }}</p>
        <p>NIP. {{ $submission->nip_kepala }}</p>
    </div>
</body>

</html>