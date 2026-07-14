<?php

namespace App\Http\Controllers;

use App\Models\KeluargaModel;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function keluarga(Request $request)
    {
        $query = KeluargaModel::query()->join('warga', 'keluarga.id', '=', 'warga.keluarga_id');
        $keluarga = $query->paginate(10);


        $data = [
            'title' => 'Penduduk',
            'subtitle' => 'Keluarga',
            'active' => 'penduduk',
            'keluarga' => $keluarga
        ];
        return view('admin.penduduk', $data);
    }
}
