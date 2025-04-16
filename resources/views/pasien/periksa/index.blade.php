@extends('layout.app')

@section('title', 'Periksa')

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
                    <h1 class="m-0">Periksa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/pasien/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Periksa</li>
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
                <div class="col-12">
                    <a href="/pasien/periksa/create" class="btn btn-sm btn-info mb-2 float-right">Periksa Online</a>
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Periksa</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dokter</th>
                                        <th>Tanggal</th>
                                        <th>Catatan</th>
                                        <th>Biaya</th>
                                        <th>Status</th>
                                        <th>Obat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($periksas) > 0)
                                        @foreach($periksas as $periksa)
                                            <tr>
                                                <td>{{ $loop->iteration ?? 'N/A' }}</td>
                                                <td>{{ $periksa->dokter->nama ?? 'N/A' }}</td>
                                                <td>{{ $periksa->tgl_periksa ?? 'N/A' }}</td>
                                                <td>{{ $periksa->catatan ?? 'N/A' }}</td>
                                                <td>{{ $periksa->biaya_periksa ? 'Rp ' . number_format($periksa->biaya_periksa, 0, ',', '.') : 'N/A' }}</td>
                                                <td>
                                                    @if ($periksa->biaya_periksa)
                                                        <span class="badge bg-success">
                                                            Sudah Diperiksa
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning">
                                                            Belum Diperiksa
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($periksa->detailPeriksas) && count($periksa->detailPeriksas) > 0)
                                                        <ul class="pl-3 mb-0">
                                                            @foreach($periksa->detailPeriksas as $detail)
                                                                <li>{{ $detail->obat->nama_obat ?? 'N/A' }} ({{ $detail->obat->kemasan ?? 'N/A' }})</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="text-muted">Tidak ada obat</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="/pasien/periksa/{{ $periksa->id }}/edit" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="/pasien/periksa/{{ $periksa->id }}" method="POST" style="display: inline;" 
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada riwayat pemeriksaan</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection