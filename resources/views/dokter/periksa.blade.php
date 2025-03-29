@extends('adminlte::page')

@section('title', 'Daftar Periksa Dokter')

@section('content_header')
    <h1>Dokter</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Periksa</h3>
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
                        <th>Pasien</th>
                        <th>Tanggal Periksa</th>
                        <th>Catatan</th>
                        <th>Biaya Periksa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>Iqbal</td>
                        <td>2025-03-24 08:00:47</td>
                        <td>Pasien mengalami demam tinggi dan batuk</td>
                        <td>150000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2</td>
                        <td>Iqbal</td>
                        <td>2025-03-27 08:00:47</td>
                        <td>Pasien mengalami sakit kepala dan pusing</td>
                        <td>200000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop