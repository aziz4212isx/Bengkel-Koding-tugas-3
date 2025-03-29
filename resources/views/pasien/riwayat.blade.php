@extends('adminlte::page')

@section('title', 'Riwayat Pasien')

@section('content_header')
    <h1>Pasien</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Riwayat Periksa</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Cari">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ID Periksa</th>
                        <th>Dokter</th>
                        <th>Tanggal Periksa</th>
                        <th>Catatan</th>
                        <th>Obat</th>
                        <th>Biaya Periksa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>P001</td>
                        <td>Andi</td>
                        <td>24-03-2025</td>
                        <td>Perlu banyak tidur</td>
                        <td>Obat tidur</td>
                        <td>170000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>P002</td>
                        <td>Andi</td>
                        <td>26-03-2025</td>
                        <td>Perlu banyak olahraga</td>
                        <td>Ashwagandha</td>
                        <td>200000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop