@extends('layouts.app')

@section('title', 'Periksa | Edit')

@section('nav-item')
    <li class="nav-item">
        <a href="/pasien/periksa" class="nav-link">
            <i class="nav-icon fas fa-sharp-duotone fa-solid fa-microscope"></i>
            <p>Periksa</p>
        </a>
    </li>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Pemeriksaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/pasien/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/pasien/periksa">Periksa</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Pemeriksaan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/pasien/periksa/{{ $periksa->id }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <!-- Pasien Field -->
                                <div class="form-group">
                                    <label for="id-pasien">Pasien</label>
                                    <select class="form-control" id="id-pasien" name="id_pasien" {{ auth()->check() && auth()->user()->role != 'admin' ? 'disabled' : '' }}>
                                        @foreach($pasiens as $pasien)
                                            <option value="{{ $pasien->id }}" {{ $periksa->id_pasien == $pasien->id ? 'selected' : '' }}>
                                                {{ $pasien->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if(auth()->check() && auth()->user()->role != 'admin')
                                        <input type="hidden" name="id_pasien" value="{{ $periksa->id_pasien }}">
                                    @endif
                                </div>

                                <!-- Dokter Field -->
                                <div class="form-group">
                                    <label for="id-dokter">Dokter</label>
                                    <select class="form-control" id="id-dokter" name="id_dokter" {{ auth()->check() && auth()->user()->role == 'pasien' ? 'disabled' : '' }}>
                                        @foreach($dokters as $dokter)
                                            <option value="{{ $dokter->id }}" {{ $periksa->id_dokter == $dokter->id ? 'selected' : '' }}>
                                                {{ $dokter->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if(auth()->check() && auth()->user()->role == 'pasien')
                                        <input type="hidden" name="id_dokter" value="{{ $periksa->id_dokter }}">
                                    @endif
                                </div>

                                <!-- Tanggal Pemeriksaan Field -->
                                <div class="form-group">
                                    <label for="tgl-periksa">Tanggal Periksa</label>
                                    <input type="datetime-local" class="form-control" id="tgl-periksa" name="tgl_periksa" 
                                        value="{{ $periksa->tgl_periksa ? date('Y-m-d\TH:i', strtotime($periksa->tgl_periksa)) : '' }}">
                                </div>

                                <!-- Catatan Field -->
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $periksa->catatan }}</textarea>
                                </div>


                               
                            </div>

                            <div class="card-footer">
                                <a href="/pasien/periksa" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
