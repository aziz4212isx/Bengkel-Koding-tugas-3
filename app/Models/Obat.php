<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    // Menentukan tabel yang benar
    protected $table = 'obat';
    
    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];

    public function detail_periksa_obat()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat', 'id');
    }
}