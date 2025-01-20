@extends('layouts.document')

@section('content')
<div class="header">
    <div class="row">
        <div class="col-8">
            <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="logo">
            <h5>BADAN PUSAT STATISTIK</h5>
            <h5>KABUPATEN GARUT</h5>
            <p>Jl. Pembangunan No.222 Tarogong Kidul</p>
            <p>G A R U T</p>
        </div>
        <div class="col-4">
            <p>Nomor : {{ $nomor_surat }}</p>
            <p>Lembar : </p>
        </div>
    </div>
</div>

<h4 class="text-center my-4">SURAT PERJALANAN DINAS (SPD)</h4>

<div class="content">
    <table class="table table-bordered">
        <tr>
            <td width="30">1.</td>
            <td width="300">Pejabat Pembuat Komitmen</td>
            <td>{{ $ppk }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Nama pegawai yang melaksanakan perjalanan dinas</td>
            <td>{{ $nama }}</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>
                a. Pangkat dan golongan<br>
                b. Jabatan/Instansi<br>
                c. Tingkat Biaya Perjalanan Dinas
            </td>
            <td>
                {{ $pangkat }}<br>
                {{ $jabatan }}<br>
                {{ $tingkat_biaya }}
            </td>
        </tr>
        <!-- Lanjutkan untuk field lainnya -->
    </table>
</div>

<style>
    .header {
        margin-bottom: 2rem;
    }
    .logo {
        width: 60px;
        height: auto;
        margin-bottom: 1rem;
    }
    .content {
        font-size: 11pt;
    }
    table td {
        padding: 0.5rem;
        vertical-align: top;
    }
</style>
@endsection
