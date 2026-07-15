<x-app-layout :title="$title" :active="$active" :subtitle="$subtitle">
    <div class="card bg-white border border-base-200 shadow-sm p-6">
        <div class="mb-6">
            <h3 class="text-xl font-semibold">Daftar Bangunan</h3>
            <p class="text-sm text-base-content/60">
                Kelola data bangunan dan informasi terkait
            </p>
        </div>

        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
            <button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false"
                aria-controls="tambah-modal" data-overlay="#tambah-modal">
                <span class="icon-[tabler--plus]"></span>
                Tambah Bangunan
            </button>
            <form id="searchForm" action="{{ route('admin.bangunan') }}" method="GET">
                <div class="relative w-full">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari bangunan..."
                        class="input input-bordered w-full pl-10" id="searchInput">
                    <span class="icon-[tabler--search] absolute left-3 top-3 text-base-content/50"></span>
                </div>
            </form>

            <script>
                let timeout = null;

                document.getElementById('searchInput').addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        document.getElementById('searchForm').submit();
                    }, 500);
                });
            </script>
        </div>

        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="table-xs table table-zebra">
                <thead class="bg-base-100 text-sm ">
                    <tr>
                        <th class="py-4 text-center w-12">No</th>
                        <th class="py-4">Nama Bangunan</th>
                        <th class="py-4">Tipe</th>
                        <th class="py-4">Alamat</th>
                        <th class="py-4">Pemilik</th>
                        <th class="py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = ($bangunan->currentPage() - 1) * $bangunan->perPage() + 1;
                    @endphp
                    @foreach ($bangunan as $item)
                        <tr class="row-hover">
                            <td class="w-12 text-center">
                                {{ $no++ }}
                            </td>
                            <td class="font-medium">{{ $item->nama_bangunan }}</td>
                            <td>{{ $item->tipe_bangunan }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->pemilik }}</td>

                            <td class="flex justify-center">
                                <button type="button" class="btn btn-text p-1 text-red-500" aria-haspopup="dialog"
                                    aria-expanded="false" aria-controls=
                                </button>

                                <button type="button" class="btn btn-text p-1 text-green-500" aria-haspopup="dialog"
                                    aria-expanded="false" aria-controls="edit-modal-{{ $item->id }}"
                                    data-overlay="#edit-modal-{{ $item->id }}" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <a href="#" class="btn btn-text p-1" aria-label="Lihat detail" title="Detail">
                                    <i class="fa-solid fa-paper-plane text-blue-500"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       <div class="p-4">
            @if(method_exists($keluarga, 'links'))
                {{ $keluarga->appends(['search' => request('search')])->links() }}
            @endif
        </div>
    </div>

    <div id="tambah-modal"
        class="overlay modal modal-middle hidden overlay-open:opacity-100 bg-black/70 overlay-open:duration-300"
        role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
            <form action="#" method="POST" class="modal-content">
                @csrf
                <div class="modal-header bg-blue-200 rounded-t-md">
                    <h3 class="modal-title text-lg font-bold">Tambah Data Keluarga</h3>
                    <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3"
                        aria-label="Close" data-overlay="#tambah-modal">
                        <span class="icon-[tabler--x] size-5"></span>
                    </button>
                </div>
                <div class="modal-body space-y-2 p-6">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="label-text font-medium mb-1 block" for="nomor_kk">Nomor Kartu Keluarga</label>
                            <input type="text" placeholder="Masukkan Nomor Kartu Keluarga..."
                                class="input input-bordered w-full" name="nomor_kk" id="nomor_kk" required />
                        </div>
                        <div>
                            <label class="label-text font-medium mb-1 block" for="namakepalakeluarga">Kepala
                                Keluarga</label>
                            <input type="text" placeholder="Masukkan Nama Kepala Keluarga..."
                                class="input input-bordered w-full" name="nama_kepala_keluarga" id="namakepalakeluarga"
                                required />
                        </div>
                    </div>

                    <div>
                        <label class="label-text font-medium mb-1 block" for="alamat">Alamat Lengkap</label>
                        <textarea placeholder="Masukkan Alamat Lengkap..." class="textarea textarea-bordered w-full" name="alamat"
                            id="alamat" rows="2" required></textarea>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="label-text font-medium mb-1 block" for="rt">RT</label>
                            <input type="text" placeholder="RT" class="input input-bordered w-full" name="rt"
                                id="rt" required />
                        </div>
                        <div>
                            <label class="label-text font-medium mb-1 block" for="rw">RW</label>
                            <input type="text" placeholder="RW" class="input input-bordered w-full"
                                name="rw" id="rw" required />
                        </div>
                        <div>
                            <label class="label-text font-medium mb-1 block" for="kode_pos">Kode Pos</label>
                            <input type="text" placeholder="Kode Pos" class="input input-bordered w-full"
                                name="kode_pos" id="kode_pos" required />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="label-text font-medium mb-1 block"
                                for="desa_kelurahan">Desa/Kelurahan</label>
                            <input type="text" placeholder="Masukkan Desa/Kelurahan..."
                                class="input input-bordered w-full" name="desa_kelurahan" id="desa_kelurahan"
                                required />
                        </div>
                        <div>
                            <label class="label-text font-medium mb-1 block" for="kecamatan">Kecamatan</label>
                            <input type="text" placeholder="Masukkan Kecamatan..."
                                class="input input-bordered w-full" name="kecamatan" id="kecamatan" required />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="label-text font-medium mb-1 block"
                                for="kabupaten_kota">Kabupaten/Kota</label>
                            <input type="text" placeholder="Masukkan Kabupaten/Kota..."
                                class="input input-bordered w-full" name="kabupaten_kota" id="kabupaten_kota"
                                required />
                        </div>
                        <div>
                            <label class="label-text font-medium mb-1 block" for="provinsi">Provinsi</label>
                            <input type="text" placeholder="Masukkan Provinsi..."
                                class="input input-bordered w-full" name="provinsi" id="provinsi" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-t border-gray-200 pt-4">
                    <button type="button" class="btn btn-soft btn-secondary"
                        data-overlay="#tambah-modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($keluarga as $item)
        <div id="edit-modal-{{ $item->id }}"
            class="overlay modal modal-middle hidden overlay-open:opacity-100 bg-black/70 overlay-open:duration-300"
            role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
                <form action="#" method="POST" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-blue-200 rounded-t-md">
                        <h3 class="modal-title text-lg font-bold">Edit Data: {{ $item->nama_kepala_keluarga }}</h3>
                        <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3"
                            aria-label="Close" data-overlay="#edit-modal-{{ $item->id }}">
                            <span class="icon-[tabler--x] size-5"></span>
                        </button>
                    </div>
                    <div class="modal-body space-y-2 p-6">

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="label-text font-medium mb-1 block">Nomor Kartu Keluarga</label>
                                <input type="text" value="{{ $item->nomor_kk }}"
                                    class="input input-bordered w-full" name="nomor_kk" required />
                            </div>
                            <div>
                                <label class="label-text font-medium mb-1 block">Kepala Keluarga</label>
                                <input type="text" value="{{ $item->nama_kepala_keluarga }}"
                                    class="input input-bordered w-full" name="nama_kepala_keluarga" required />
                            </div>
                        </div>

                        <div>
                            <label class="label-text font-medium mb-1 block">Alamat Lengkap</label>
                            <textarea class="textarea textarea-bordered w-full" name="alamat" rows="2" required>{{ $item->alamat }}</textarea>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="label-text font-medium mb-1 block">RT</label>
                                <input type="text" value="{{ $item->rt }}"
                                    class="input input-bordered w-full" name="rt" required />
                            </div>
                            <div>
                                <label class="label-text font-medium mb-1 block">RW</label>
                                <input type="text" value="{{ $item->rw }}"
                                    class="input input-bordered w-full" name="rw" required />
                            </div>
                            <div>
                                <label class="label-text font-medium mb-1 block">Kode Pos</label>
                                <input type="text" value="{{ $item->kode_pos }}"
                                    class="input input-bordered w-full" name="kode_pos" required />
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="label-text font-medium mb-1 block">Desa/Kelurahan</label>
                                <input type="text" value="{{ $item->desa_kelurahan }}"
                                    class="input input-bordered w-full" name="desa_kelurahan" required />
                            </div>
                            <div>
                                <label class="label-text font-medium mb-1 block">Kecamatan</label>
                                <input type="text" value="{{ $item->kecamatan }}"
                                    class="input input-bordered w-full" name="kecamatan" required />
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="label-text font-medium mb-1 block">Kabupaten/Kota</label>
                                <input type="text" value="{{ $item->kabupaten_kota }}"
                                    class="input input-bordered w-full" name="kabupaten_kota" required />
                            </div>
                            <div>
                                <label class="label-text font-medium mb-1 block">Provinsi</label>
                                <input type="text" value="{{ $item->provinsi }}"
                                    class="input input-bordered w-full" name="provinsi" required />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-t border-gray-200 pt-4">
                        <button type="button" class="btn btn-soft btn-secondary"
                            data-overlay="#edit-modal-{{ $item->id }}">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="delete-modal-{{ $item->id }}"
            class="overlay modal modal-middle hidden overlay-open:opacity-100 bg-black/70 overlay-open:duration-300"
            role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-sm modal-dialog-centered">
                <form action="#" method="POST" class="modal-content p-6 text-center">
                    @csrf

                    <div class="flex justify-center mb-4 text-error">
                        <span class="icon-[tabler--alert-triangle] size-14"></span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Konfirmasi Hapus</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Apakah Anda yakin ingin menghapus data keluarga
                        <strong>{{ $item->nama_kepala_keluarga }}</strong>? Data yang dihapus tidak dapat dikembalikan.
                    </p>

                    <div class="flex gap-3 justify-center">
                        <button type="button" class="btn btn-soft btn-secondary"
                            data-overlay="#delete-modal-{{ $item->id }}">Batal</button>
                        <button type="submit" class="btn btn-error text-white shadow-sm">Ya, Hapus Data</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

</x-app-layout>
