<x-app-layout :title="$title" :active="$active" :subtitle="$subtitle">
    <div class="card bg-white border border-base-200 shadow-sm p-6">
        <div class="mb-6">
            <h3 class="text-lg font-semibold">Daftar Keluarga</h3>
            <p class="text-sm text-base-content/60">
                Kelola data keluarga dan informasi anggota
            </p>
        </div>

        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">

            <!-- BUTTON TAMBAH -->
            <button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false"
                aria-controls="tambah-modal" data-overlay="#tambah-modal">
                <span class="icon-[tabler--plus]"></span>
                Tambah Keluarga
            </button>

            <!-- SEARCH -->
            <div class="relative w-full md:w-1/3">
                <input type="text" placeholder="Cari keluarga..." class="input input-bordered w-full pl-10">
                <span class="icon-[tabler--search] absolute left-3 top-3 text-base-content/50"></span>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="table-xs table table-zebra">
                <thead class="bg-base-100 text-sm ">
                    <tr>
                        <th class="py-4 text-center w-10">No</th>
                        <th class="py-4 text-center">No KK</th>
                        <th class="py-4 text-center">Kepala Keluarga</th>
                        <th class="py-4 text-center">Alamat</th>
                        <th class="py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keluarga as $item)
                        <tr class="hover">
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-medium">{{ $item->nomor_kk }}</td>
                            <td>{{ $item->nama_kepala_keluarga }}</td>
                            <td>{{ $item->alamat }}</td>

                            <!-- ACTION -->
                            <td class="flex justify-center gap-2">
                                <button type="button" class="btn btn-sm btn-ghost"
                                    data-overlay="#modal-detail-{{ $item->id }}">
                                    👁
                                </button>

                                <button type="button" class="btn btn-sm btn-ghost text-blue-500"
                                    data-overlay="#modal-edit-{{ $item->id }}">
                                    ✏️
                                </button>

                                <button type="button" class="btn btn-sm btn-ghost text-red-500"
                                    data-overlay="#modal-delete-{{ $item->id }}">
                                    🗑
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


    <div id="tambah-modal"
        class="overlay modal overlay-open:opacity-100 bg-black/70 overlay-open:duration-300 modal-middle hidden"
        role="dialog" tabindex="-1">
        <div class="modal-dialog-lg modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Keluarga</h3>
                    <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3"
                        aria-label="Close" data-overlay="#tambah-modal">
                        <span class="icon-[tabler--x] size-4"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="label-text" for="nomor_kk">Nomor Kartu Keluarga </label>
                            <input type="text" placeholder="Masukan Nomor Kartu Keluarga . . ." class="input"
                                name="nomor_kk" id="nomor_kk" required />
                        </div>
                        <div>
                            <label class="label-text" for="namakepalakeluarga">Kepala Keluarga </label>
                            <input type="text" placeholder="Masukan Nama Kepala Keluarga . . ." class="input"
                                name="nama_kepala_keluarga" id="namakepalakeluarga" required />
                        </div>
                    </div>
                    <div>
                        <label class="label-text" for="alamat">Alamat </label>
                        <textarea placeholder="Masukan Alamat . . ." class="input" name="alamat"
                            id="alamat" required></textarea>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="label-text" for="rt">RT </label>
                            <input type="text" placeholder="Masukan RT . . ." class="input" name="rt"
                                id="rt" required />
                        </div>
                        <div>
                            <label class="label-text" for="rw">RW </label>
                            <input type="text" placeholder="Masukan RW . . ." class="input" name="rw"
                                id="rw" required />
                        </div>
                    </div>
                    <div>
                        <label class="label-text" for="kode_pos">Kode Pos </label>
                        <input type="text" placeholder="Masukan Kode Pos . . ." class="input" name="kode_pos"
                            id="kode_pos" required />
                    </div>
                    <div>
                        <label class="label-text" for="desa_kelurahan">Desa/Kelurahan </label>
                        <input type="text" placeholder="Masukan Desa/Kelurahan . . ." class="input"
                            name="desa_kelurahan" id="desa_kelurahan" required />
                    </div>
                    <div>
                        <label class="label-text" for="kecamatan">Kecamatan </label>
                        <input type="text" placeholder="Masukan Kecamatan . . ." class="input" name="kecamatan"
                            id="kecamatan" required />
                    </div>
                    <div>
                        <label class="label-text" for="kabupaten_kota">Kabupaten/Kota </label>
                        <input type="text" placeholder="Masukan Kabupaten/Kota . . ." class="input"
                            name="kabupaten_kota" id="kabupaten_kota" required />
                    </div>
                    <div>
                        <label class="label-text" for="provinsi">Provinsi </label>
                        <input type="text" placeholder="Masukan Provinsi . . ." class="input" name="provinsi"
                            id="provinsi" required />
                    </div>

                    {{-- <div>
                        <label class="label-text" for="file_kk">File Kartu Keluarga </label>
                        <input type="file" class="file-input file-input-bordered w-full" name="file_kk" id="file_kk" required />
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-soft btn-secondary"
                        data-overlay="#tambah-modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>




    <!-- ===================== LOOP MODAL ===================== -->
    @foreach ($keluarga as $item)
        <!-- DETAIL -->
        <div id="modal-detail-{{ $item->id }}" class="overlay modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Detail Keluarga</h5>
                    </div>

                    <div class="modal-body space-y-2 text-sm">
                        <p><b>No KK:</b> {{ $item->nomor_kk }}</p>
                        <p><b>Nama:</b> {{ $item->nama_kepala_keluarga }}</p>
                        <p><b>Alamat:</b> {{ $item->alamat }}</p>
                        <p><b>RT/RW:</b> {{ $item->rt }}/{{ $item->rw }}</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn"
                            data-overlay="#modal-detail-{{ $item->id }}">Tutup</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- EDIT -->
        <div id="modal-edit-{{ $item->id }}" class="overlay modal">
            <div class="modal-dialog modal-lg">
                <form action="/update/{{ $item->id }}" method="POST" enctype="multipart/form-data"
                    class="modal-content">
                    @csrf @method('PUT')

                    <div class="modal-header">
                        <h5>Edit Data</h5>
                    </div>

                    <div class="modal-body grid md:grid-cols-2 gap-4">
                        <input name="nomor_kk" class="input input-bordered" value="{{ $item->nomor_kk }}">
                        <input name="nama_kepala_keluarga" class="input input-bordered"
                            value="{{ $item->nama_kepala_keluarga }}">

                        <input name="alamat" class="input input-bordered md:col-span-2"
                            value="{{ $item->alamat }}">

                        <input name="rt" class="input input-bordered" value="{{ $item->rt }}">
                        <input name="rw" class="input input-bordered" value="{{ $item->rw }}">

                        <input type="file" name="file_kk" class="file-input file-input-bordered md:col-span-2">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn"
                            data-overlay="#modal-edit-{{ $item->id }}">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- DELETE -->
        <div id="modal-delete-{{ $item->id }}" class="overlay modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Konfirmasi</h5>
                    </div>

                    <div class="modal-body text-sm">
                        Yakin hapus <b>{{ $item->nama_kepala_keluarga }}</b> ?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn"
                            data-overlay="#modal-delete-{{ $item->id }}">Batal</button>

                        <form action="/delete/{{ $item->id }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-error">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>
