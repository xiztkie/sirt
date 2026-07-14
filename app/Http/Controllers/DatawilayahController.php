<?php

namespace App\Http\Controllers;

use App\Jobs\SyncKabkotaJob;
use App\Jobs\SyncKecamatanJob;
use App\Jobs\SyncKelurahanJob;
use App\Jobs\SyncProvinsiJob;
use App\Models\KabkotaModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\ProvinsiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatawilayahController extends Controller
{
    public function provinsi(Request $request)
    {
        $query = ProvinsiModel::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $provinsi = $query->paginate(8);

        $data = [
            'title' => 'Data Provinsi',
            'active' => 'provinsi',
            'provinsi' => $provinsi,
            'search' => $request->search ?? ''
        ];

        return view('admin.dataprovinsi', $data);
    }

    public function kabkota(Request $request)
    {
        $query = KabkotaModel::select('kabkota.id', 'kabkota.code', 'kabkota.name_kabkota', 'kabkota.provinsi_id', 'provinsi.name_provinsi', 'provinsi.code as code_provinsi')
            ->leftJoin('provinsi', 'provinsi.id', '=', 'kabkota.provinsi_id');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kabkota.name_kabkota', 'like', "%{$search}%")
                    ->orWhere('provinsi.name_provinsi', 'like', "%{$search}%")
                    ->orWhere('provinsi.code', 'like', "%{$search}%");
            });
        }

        $kabkota = $query->paginate(8);
        $data = [
            'title' => 'Data Kabupaten/Kota',
            'active' => 'kabkota',
            'kabkota' => $kabkota,
            'search' => $search ?? ''
        ];

        return view('admin.datakabkota', $data);
    }

    public function kecamatan(Request $request)
    {
        $query = KecamatanModel::select(
            'kecamatan.id',
            'kecamatan.code',
            'kecamatan.name_kecamatan',
            'kecamatan.kabkota_id',
            'kabkota.name_kabkota',
            'kabkota.code as code_kabkota',
            'provinsi.name_provinsi',
            'provinsi.code as code_provinsi'
        )
            ->leftJoin('kabkota', 'kabkota.id', '=', 'kecamatan.kabkota_id')->leftJoin('provinsi', 'provinsi.id', '=', 'kabkota.provinsi_id');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kecamatan.name_kecamatan', 'like', "%{$search}%")
                    ->orWhere('kabkota.name_kabkota', 'like', "%{$search}%")
                    ->orWhere('provinsi.name_provinsi', 'like', "%{$search}%")
                    ->orWhere('kabkota.code', 'like', "%{$search}%");
            });
        }

        $kecamatan = $query->paginate(8);
        $data = [
            'title' => 'Data Kecamatan',
            'active' => 'kecamatan',
            'kecamatan' => $kecamatan,
            'search' => $search ?? ''
        ];

        return view('admin.datakecamatan', $data);
    }

    public function kelurahan(Request $request)
    {
        $query = KelurahanModel::select(
            'kelurahan.id',
            'kelurahan.code',
            'kelurahan.name_kelurahan',
            'kelurahan.kecamatan_id',
            'kecamatan.name_kecamatan',
            'kabkota.name_kabkota',
            'provinsi.name_provinsi',
            'provinsi.code as code_provinsi',
            'kabkota.code as code_kabkota',
            'kecamatan.code as code_kecamatan'
        )
            ->leftJoin('kecamatan', 'kecamatan.id', '=', 'kelurahan.kecamatan_id')
            ->leftJoin('kabkota', 'kabkota.id', '=', 'kecamatan.kabkota_id')
            ->leftJoin('provinsi', 'provinsi.id', '=', 'kabkota.provinsi_id');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kelurahan.name_kelurahan', 'like', "%{$search}%")
                    ->orWhere('kecamatan.name_kecamatan', 'like', "%{$search}%")
                    ->orWhere('kabkota.name_kabkota', 'like', "%{$search}%")
                    ->orWhere('provinsi.name_provinsi', 'like', "%{$search}%")
                    ->orWhere('kecamatan.code', 'like', "%{$search}%");
            });
        }

        $kelurahan = $query->paginate(8);

        $data = [
            'title' => 'Data Kelurahan',
            'active' => 'kelurahan',
            'kelurahan' => $kelurahan,
            'search' => $request->search ?? ''
        ];

        return view('admin.datakelurahan', $data);
    }

    public function syncprovinsi()
    {
        SyncProvinsiJob::dispatch();
        return back()->with('success', 'Sync provinsi sedang diproses...');
    }

    public function synckabkota()
    {
        SyncKabkotaJob::dispatch();
        return back()->with('success', 'Sync kabkota sedang diproses...');
    }

    public function synckecamatan()
    {
        SyncKecamatanJob::dispatch();
        return back()->with('success', 'Sync kecamatan sedang diproses...');
    }

    public function synckelurahan()
    {
        SyncKelurahanJob::dispatch();
        return back()->with('success', 'Sync kelurahan sedang diproses...');
    }

    /**
     * Select endpoints for Tom-Select (web routes).
     * Returns JSON arrays of {id, text} items.
     */
    public function selectProvinsi(Request $request)
    {
        $q = $request->input('q', $request->input('search', ''));

        if ($request->filled('id')) {
            $item = ProvinsiModel::select('id', DB::raw("name_provinsi as text"))
                ->where('id', $request->id)
                ->first();

            return response()->json($item ? [$item] : []);
        }

        $query = ProvinsiModel::select('id', DB::raw("name_provinsi as text"));
        if ($q) {
            $query->where('name_provinsi', 'like', "%{$q}%");
        }

        $items = $query->orderBy('name_provinsi')->limit(50)->get();

        return response()->json($items);
    }

    public function selectKabkota(Request $request)
    {
        $q = $request->input('q', $request->input('search', ''));

        if ($request->filled('id')) {
            $item = KabkotaModel::select('id', DB::raw("name_kabkota as text"))
                ->where('id', $request->id)
                ->first();

            return response()->json($item ? [$item] : []);
        }

        $query = KabkotaModel::select('id', DB::raw("name_kabkota as text"));

        if ($request->filled('provinsi_id')) {
            $query->where('provinsi_id', $request->provinsi_id);
        }

        if ($q) {
            $query->where('name_kabkota', 'like', "%{$q}%");
        }

        $items = $query->orderBy('name_kabkota')->limit(50)->get();

        return response()->json($items);
    }

    public function selectKecamatan(Request $request)
    {
        $q = $request->input('q', $request->input('search', ''));

        if ($request->filled('id')) {
            $item = KecamatanModel::select('id', DB::raw("name_kecamatan as text"))
                ->where('id', $request->id)
                ->first();

            return response()->json($item ? [$item] : []);
        }

        $query = KecamatanModel::select('id', DB::raw("name_kecamatan as text"));

        if ($request->filled('kabkota_id')) {
            $query->where('kabkota_id', $request->kabkota_id);
        }

        if ($q) {
            $query->where('name_kecamatan', 'like', "%{$q}%");
        }

        $items = $query->orderBy('name_kecamatan')->limit(50)->get();

        return response()->json($items);
    }

    public function selectKelurahan(Request $request)
    {
        $q = $request->input('q', $request->input('search', ''));

        if ($request->filled('id')) {
            $item = KelurahanModel::select('id', DB::raw("name_kelurahan as text"))
                ->where('id', $request->id)
                ->first();

            return response()->json($item ? [$item] : []);
        }

        $query = KelurahanModel::select('id', DB::raw("name_kelurahan as text"));

        if ($request->filled('kecamatan_id')) {
            $query->where('kecamatan_id', $request->kecamatan_id);
        }

        if ($q) {
            $query->where('name_kelurahan', 'like', "%{$q}%");
        }

        $items = $query->orderBy('name_kelurahan')->limit(50)->get();

        return response()->json($items);
    }
}
