@extends('layouts.document')

@section('content')
<div class="header text-center">
    <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="logo">
    <h4 class="mt-2">BADAN PUSAT STATISTIK</h4>
    <h4>KABUPATEN GARUT</h4>
    <h4 class="mt-4 text-decoration-underline">SURAT TUGAS</h4>
    <p class="mt-2">Nomor: {{ $nomor_surat }}</p>
</div>

<div class="content mt-4">
    <table class="table table-borderless">
        <tr>
            <td width="120">Menimbang</td>
            <td width="20">:</td>
            <td>Bahwa untuk kepentingan tugas dalam kegiatan yang dilakukan BPS Kabupaten Garut dipandang perlu untuk memberikan surat tugas.</td>
        </tr>
        <tr>
            <td>Mengingat</td>
            <td>:</td>
            <td>
                <ol>
                    <li>Undang-Undang No. 16 Tahun 1997 Tentang Statistik;</li>
                    <li>Peraturan Pemerintah RI No. 51 Tahun 1999, Tentang Penyelenggaraan Statistik;</li>
                    <li>Keputusan Presiden RI No. 166 Tahun 2000;</li>
                    <li>Peraturan Pemerintah No. 86 Tahun 2007 tentang Badan Pusat Statistik;</li>
                    <li>Peraturan Kepala Badan Pusat Statistik Nomor 116 Tahun 2014;</li>
                    <li>Peraturan BPS No. 8 Tahun 2020 tentang Organisasi dan Tata Kerja BPS Provinsi dan BPS Kabupaten/Kota;</li>
                </ol>
            </td>
        </tr>
    </table>

    <div class="mt-4">
        <h5 class="text-center mb-4">MEMBERI PERINTAH</h5>
        
        <table class="table table-borderless">
            <tr>
                <td width="120">Kepada</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $nama }}</td>
            </tr>
            <tr>
                <td>NIP/NIK</td>
                <td>:</td>
                <td>{{ $nip }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $jabatan }}</td>
            </tr>
            <tr class="mt-3">
                <td>Untuk</td>
                <td>:</td>
                <td>{{ $tujuan_tugas }}</td>
            </tr>
            <tr>
                <td>Jangka Waktu</td>
                <td>:</td>
                <td>{{ $jangka_waktu }}</td>
            </tr>
        </table>
    </div>

    <div class="signature mt-5">
        <div class="text-end">
            <p>Garut, {{ $tanggal_surat }}</p>
            <p class="mb-5">Kepala,</p>
            <p class="mb-0"><u>{{ $nama_kepala }}</u></p>
            <p>NIP. {{ $nip_kepala }}</p>
        </div>
    </div>
</div>

<div class="footer text-center mt-5">
    <p>Jalan Pembangunan No. 222 Tarogong Kidul, Garut, Jawa Barat - Indonesia</p>
    <p>Kode Pos 44151</p>
    <p>Telp.: (0262) 233273 Fax: (0262) 4893051 e-mail: bps3205@bps.go.id</p>
</div>

<style>
    .header {
        margin-bottom: 2rem;
    }
    .logo {
        width: 80px;
        height: auto;
    }
    .content {
        font-size: 12pt;
        line-height: 1.6;
    }
    .footer {
        font-size: 10pt;
        color: #666;
        border-top: 1px solid #ddd;
        padding-top: 1rem;
    }
    .signature {
        margin-top: 3rem;
    }
    table td {
        padding: 0.25rem;
    }
</style>
@endsection