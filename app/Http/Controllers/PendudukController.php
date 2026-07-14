<?php

namespace App\Http\Controllers;

use App\Models\KeluargaModel;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function keluarga(Request $request)
    {
        $query = KeluargaModel::query();
        if ($request->has('search')) {
            $query->where('nama_kepala_keluarga', 'like', '%' . $request->search . '%')
                ->orWhere('nomor_kk', 'like', '%' . $request->search . '%');
        }
        $keluarga = $query->paginate(8);

        $data = [
            'title' => 'Penduduk',
            'subtitle' => 'Keluarga',
            'active' => 'penduduk',
            'keluarga' => $keluarga,
            'search' => $request->search
        ];

        return view('admin.datapenduduk', $data);
    }
}
