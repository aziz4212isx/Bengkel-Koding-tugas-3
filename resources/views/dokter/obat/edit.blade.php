@extends('layout.app')

@section('title', 'Kesehatan | Edit Pemeriksaan')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Pemeriksaan</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Pemeriksaan</h3>
                        </div>
                        <form method="POST" action="{{ url('/pasien/periksa/'.$periksa->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="dokter">Dokter</label>
                                    <select class="form-control" id="dokter" name="id_dokter">
                                        @foreach($dokters as $dokter)
                                            <option value="{{ $dokter->id }}" {{ $dokter->id == $periksa->id_dokter ? 'selected' : '' }}>
                                                {{ $dokter->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="obat_ids">Pilih Obat</label>
                                    <select class="form-control" id="obat_ids" name="obat_ids[]" multiple>
                                        @foreach($obats as $obat)
                                            <option value="{{ $obat->id }}" 
                                                {{ in_array($obat->id, $periksa->detailPeriksas->pluck('id_obat')->toArray()) ? 'selected' : '' }}>
                                                {{ $obat->nama_obat }} - Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan">{{ $periksa->catatan }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="biaya_periksa">Biaya Pemeriksaan</label>
                                    <input type="number" class="form-control" id="biaya_periksa" name="biaya_periksa" value="{{ $periksa->biaya_periksa }}">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
