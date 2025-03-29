@extends('adminlte::page')

@section('title', 'Form Periksa Pasien')

@section('content_header')
    <h1>Pasien</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Form Umum</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title">Periksa</h3>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="namaAnda">Nama Anda</label>
                    <input type="text" class="form-control" id="namaAnda" placeholder="Masukkan nama anda">
                </div>
                
                <div class="form-group">
                    <label for="pilihDokter">Pilih Dokter</label>
                    <select class="form-control" id="pilihDokter">
                        <option>Value 1</option>
                        <option>Value 2</option>
                        <option>Value 3</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop