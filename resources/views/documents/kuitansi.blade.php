@extends('layouts.document')

@section('content')
<div class="header text-center">
    <h5>BADAN PUSAT STATISTIK</h5>
    <h5>KABUPATEN GARUT</h5>
    <h4 class="mt-4">K U I T A N S I</h4>
</div>

<div class="content mt-4">
    <table class="table table-borderless">
        <tr>
            <td width="200">Sudah terima dari</td>
            <td width="20">:</td>
            <td>Kuasa Pengguna Anggaran BPS Kabupaten Garut</td>
        </tr>
        <tr>
            <td>Uang sebesar</td>
            <td>:</td>
            <td><strong>Rp{{ number_format($jumlah, 0, ',', '.') }},-</strong></td>
        </tr>
        <tr>
            <td>Untuk pembayaran</td>
            <td>:</td>
            <td>{{ $keterangan }}</td>
        </tr>
        <tr>
            <td>Berdasarkan SPPD</td>
            <td>:</td>
            <td>Nomor: {{ $nomor_sppd }}<br>Tanggal {{ $tanggal_sppd }}</td>
        </tr>
        <tr>
            <td>Untuk Perjalanan Dinas dari</td>
            <td>:</td>
            <td>{{ $rute_perjalanan }}</td>
        </tr>
        <tr>
            <td>Terbilang</td>
            <td>:</td>
            <td><strong>{{ $terbilang }}</strong></td>
        </tr>
    </table>

    <div class="signatures mt-5">
        <div class="row">
            <div class="col-4">
                <p>Setuju dibayar:</p>
                <p>An. Kuasa Pengguna Anggaran</p>
                <p>BPS Kabupaten Garut</p>
                <p>Pejabat Pembuat Komitmen</p>
                <br><br><br>
                <p><u>{{ $nama_ppk }}</u></p>
                <p>NIP. {{ $nip_ppk }}</p>
            </div>
            <div class="col-4">
                <p>Lunas dibayar:</p>
                <p>Bendahara Pengeluaran</p>
                <p>BPS Kabupaten Garut</p>
                <br><br><br><br>
                <p><u>{{ $nama_bendahara }}</u></p>
                <p>NIP. {{ $nip_bendahara }}</p>
            </div>
            <div class="col-4">
                <p>Garut, {{ $tanggal_kuitansi }}</p>
                <p>Yang menerima/bepergian,</p>
                <br><br><br><br>
                <p><u>{{ $nama_penerima }}</u></p>
                <p>NIP. {{ $nip_penerima }}</p>
            </div>
        </div>
    </div>
</div>

<style>
    .header {
        margin-bottom: 2rem;
    }
    .content {
        font-size: 12pt;
        line-height: 1.6;
    }
    .signatures {
        font-size: 11pt;
    }
    table td {
        padding: 0.5rem;
        vertical-align: top;
    }
</style>
@endsection