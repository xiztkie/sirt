<?php

namespace App\Http\Controllers;

use App\Models\BangunanModel;
use App\Models\FotobangunanModel;
use App\Models\TempattinggalModel;
use App\Models\TipebangunanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BangunanController extends Controller
{
    public function bangunan(Request $request)
    {
        $query = BangunanModel::query();

        if (filled($request->search)) {
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
            'tipebangunan' => TipebangunanModel::all(),
            'search' => $request->search
        ];

        return view('admin.databangunan', $data);
    }

    public function detailbangunan($id)
    {
        $ids = decrypt($id);
        $bangunan = BangunanModel::select('bangunan.*', 'tipe_bangunans.nama as tipe_bangunan')
            ->leftjoin('tipe_bangunans', 'bangunan.tipe_bangunan_id', '=', 'tipe_bangunans.id')
            ->where('bangunan.id', $ids)
            ->firstOrFail();
        $fotobangunan = FotobangunanModel::where('bangunan_id', $ids)->get();
        $riwayattinggal = TempattinggalModel::select('tempat_tinggal.*', 'warga.nama', 'warga.nik', 'keluarga.nomor_kk')
            ->leftjoin('warga', 'tempat_tinggal.warga_id', '=', 'warga.id')
            ->leftjoin('keluarga', 'warga.keluarga_id', '=', 'keluarga.id')
            ->where('tempat_tinggal.bangunan_id', $ids)
            ->orderby('tempat_tinggal.tanggal_mulai_tinggal', 'desc')
            ->get();
        $data = [
            'title' => 'Detail Bangunan',
            'subtitle' => $bangunan->blok . $bangunan->nomor . ' - ' . $bangunan->alamat,
            'active' => 'bangunan',
            'bangunan' => $bangunan,
            'fotobangunan' => $fotobangunan,
            'riwayattinggal' => $riwayattinggal,
        ];

        return view('admin.detailbangunan', $data);
    }

    public function tambahbangunan(Request $request)
    {
        try {
            $request->validate([
                'nomor' => 'required',
                'blok' => 'required',
                'alamat' => 'required',
                'pemilik' => 'required',
                'kontak' => 'required',
                'tipe_bangunan_id' => 'required|exists:tipe_bangunans,id',
            ]);

            $bangunan = BangunanModel::create($request->all());

            return redirect()->route('bangunan.detail', ['id' => encrypt($bangunan->id)])->with('success', 'Data bangunan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data bangunan: ' . $e->getMessage());
        }
    }

    public function editbangunan(Request $request, $id)
    {
        try {
            $request->validate([
                'nomor' => 'required',
                'blok' => 'required',
                'alamat' => 'required',
                'pemilik' => 'required',
                'kontak' => 'required',
                'tipe_bangunan_id' => 'required|exists:tipe_bangunans,id',
            ]);
            $ids = decrypt($id);
            $bangunan = BangunanModel::findOrFail($ids);
            $bangunan->update($request->all());

            return redirect()->back()->with('success', 'Data bangunan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data bangunan: ' . $e->getMessage());
        }
    }

    public function hapusbangunan($id)
    {
        try {
            $ids = decrypt($id);
            $bangunan = BangunanModel::findOrFail($ids);
            $bangunan->delete();

            return redirect()->route('bangunan')->with('success', 'Data bangunan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data bangunan: ' . $e->getMessage());
        }
    }

    public function tambahfotobangunan(Request $request)
    {
        try {
            $request->validate([
                'bangunan_id' => 'required|exists:bangunan,id',
                'foto' => 'required|image|mimes:jpeg,jpg,bmp,png|max:2048',
            ]);

            $filename = time() . '_' . bin2hex(random_bytes(8)) . '.' . $request->file('foto')->getClientOriginalExtension();
            $path = 'bangunan/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($request->file('foto')));

            FotobangunanModel::create([
                'bangunan_id' => $request->bangunan_id,
                'foto' => $path,
            ]);

            return redirect()->back()->with('success', 'Foto bangunan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan foto bangunan: ' . $e->getMessage());
        }
    }

    public function hapusfotobangunan($id)
    {
        try {
            $ids = decrypt($id);
            $foto = FotobangunanModel::findOrFail($ids);
            Storage::delete($foto->foto);
            $foto->delete();

            return redirect()->back()->with('success', 'Foto bangunan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus foto bangunan: ' . $e->getMessage());
        }
    }

    public function setlokasibangunan(Request $request, $id)
    {
        try {
            $request->validate([
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);

            $ids = decrypt($id);
            $bangunan = BangunanModel::findOrFail($ids);
            $bangunan->latitude = $request->latitude;
            $bangunan->longitude = $request->longitude;
            $bangunan->save();

            return redirect()->back()->with('success', 'Lokasi bangunan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui lokasi bangunan: ' . $e->getMessage());
        }
    }
}
