<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulir Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 2cm;
        }
        .header {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            color: #dc3545;
            margin: 0;
        }
        .subtitle {
            color: #666;
            margin: 5px 0 0;
        }
        .content {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        .field {
            margin-bottom: 15px;
            border-bottom: 1px dotted #ddd;
            padding-bottom: 10px;
        }
        .label {
            font-weight: bold;
            color: #dc3545;
        }
        .privacy-notice {
            font-size: 12px;
            background: #f8f9fa;
            padding: 10px;
            margin-top: 20px;
        }
        .status-stamp {
            margin-top: 30px;
            border: 2px solid #dc3545;
            color: #dc3545;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">FORMULIR PENGADUAN MASYARAKAT</h1>
        <p class="subtitle">Nomor Pengaduan: PGD-{{ sprintf('%04d', $submission->id) }}/{{ date('Y') }}</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="label">Nama Pelapor:</div>
            <div>{{ $submission->nama }}</div>
        </div>

        <div class="field">
            <div class="label">Lokasi Kejadian:</div>
            <div>{{ $submission->alamat }}</div>
        </div>

        <div class="field">
            <div class="label">Isi Pengaduan:</div>
            <div>{{ $submission->tujuan }}</div>
        </div>

        <div class="field">
            <div class="label">Tanggal Laporan:</div>
            <div>{{ $submission->created_at->format('d F Y H:i:s') }}</div>
        </div>
    </div>

    <div class="privacy-notice">
        <strong>Pemberitahuan Privasi:</strong>
        <p>Identitas pelapor akan dijaga kerahasiaannya sesuai dengan ketentuan yang berlaku.</p>
    </div>

    <div class="status-stamp">
        STATUS PENGADUAN: {{ strtoupper($submission->status) }}
    </div>
</body>
</html>