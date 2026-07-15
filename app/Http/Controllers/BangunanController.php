<?php

namespace App\Http\Controllers;

use App\Models\BangunanModel;
use Illuminate\Http\Request;

class BangunanController extends Controller
{
    public function bangunan(Request $request)
    {
        $query = BangunanModel::query();

        if(filled($request->search)) {
            $query->where('nomor', 'like', '%' . $request->search . '%')
                ->orWhere('alamat', 'like', '%' . $request->search . '%')
                ->orWhere('pemilik', 'like', '%' . $request->search . '%');
        }

        $bangunan = $query->paginate(8);
         $data = [
            'title' => 'Bangunan',
            'subtitle' => 'Data Bangunan',
            'active' => 'bangunan',
            'bangunan' => $bangunan,
            'search' => $request->search
        ];

        return view('admin.databangunan', $data);
    }
}
