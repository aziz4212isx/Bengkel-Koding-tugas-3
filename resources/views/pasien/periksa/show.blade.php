@extends('layout.app')

@section('title', 'Periksa | Detail')

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
                    <h1 class="m-0">Detail Pemeriksaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/pasien/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/pasien/periksa">Periksa</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pemeriksaan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pasien:</label>
                                        <p class="form-control">{{ $periksa->pasien->nama ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Dokter:</label>
                                        <p class="form-control">{{ $periksa->dokter->nama ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Periksa:</label>
                                        <p class="form-control">{{ $periksa->tgl_periksa ?? 'Belum diperiksa' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <p class="form-control">
                                            @if ($periksa->tgl_periksa)
                                                <span class="badge bg-success">Sudah Diperiksa</span>
                                            @else
                                                <span class="badge bg-warning">Belum Diperiksa</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Biaya Pemeriksaan:</label>
                                        <p class="form-control">
                                            {{ $periksa->biaya_periksa ? 'Rp ' . number_format($periksa->biaya_periksa, 0, ',', '.') : 'Belum ada biaya' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Catatan:</label>
                                <p class="form-control" style="min-height: 100px;">{{ $periksa->catatan ?? 'Tidak ada catatan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Obat yang Diberikan</h3>
                        </div>
                        <div class="card-body">
                            @if(isset($periksa->detailPeriksas) && count($periksa->detailPeriksas) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Kemasan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($periksa->detailPeriksas as $index => $detail)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $detail->obat->nama_obat ?? 'N/A' }}</td>
                                                <td>{{ $detail->obat->kemasan ?? 'N/A' }}</td>
                                                <td>{{ $detail->obat->harga ? 'Rp ' . number_format($detail->obat->harga, 0, ',', '.') : 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Total Biaya Obat:</th>
                                            <th>
                                                <?php $totalObat = 0; ?>
                                                @foreach($periksa->detailPeriksas as $detail)
                                                    <?php $totalObat += $detail->obat->harga ?? 0; ?>
                                                @endforeach
                                                Rp {{ number_format($totalObat, 0, ',', '.') }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Total Biaya Pemeriksaan:</th>
                                            <th>Rp {{ number_format($periksa->biaya_periksa + $totalObat, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            @else
                                <div class="alert alert-info">
                                    Tidak ada obat yang diberikan untuk pemeriksaan ini.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <a href="/pasien/periksa" class="btn btn-secondary">Kembali</a>
                    
                    @if(!$periksa->tgl_periksa)
                        <form action="/pasien/periksa/{{ $periksa->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pemeriksaan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Batalkan Pemeriksaan</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection