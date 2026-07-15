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
            <form id="searchForm" action="{{ route('bangunan') }}" method="GET">
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
                                    aria-expanded="false" aria-controls="hapus-modal-{{ $item->id }}">
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
            @if (method_exists($bangunan, 'links'))
                {{ $bangunan->appends(['search' => request('search')])->links() }}
            @endif
        </div>
    </div>

    <div id="tambah-modal"
        class="overlay modal modal-middle hidden overlay-open:opacity-100 bg-black/70 overlay-open:duration-300"
        role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
            <form action="{{ route('bangunan.tambah') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header bg-blue-200 rounded-t-md">
                    <h3 class="modal-title text-lg font-bold">Tambah Data Bangunan</h3>
                    <button type="button" class="btn btn-text btn-circle btn-sm absolute inset-e-3 top-3"
                        aria-label="Close" data-overlay="#tambah-modal">
                        <span class="icon-[tabler--x] size-5"></span>
                    </button>
                </div>
                <div class="modal-body space-y-4 p-6">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="label-text font-semibold mb-2 block" for="nomor_bangunan">Nomor
                                Bangunan</label>
                            <input type="text" placeholder="Masukkan nomor..."
                                class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="nomor" id="nomor_bangunan" required />
                        </div>
                        <div>
                            <label class="label-text font-semibold mb-2 block" for="blok_bangunan">Blok</label>
                            <input type="text" placeholder="Masukkan blok..."
                                class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="blok" id="blok_bangunan" required />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="label-text font-semibold mb-2 block" for="tipe_bangunan">Tipe Bangunan</label>
                            <select
                                class="select select-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="tipe_bangunan_id" id="tipe_bangunan" required>
                                <option value="">Pilih tipe bangunan</option>
                                @foreach ($tipebangunan as $tipe)
                                    <option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="label-text font-semibold mb-2 block" for="pemilik">Pemilik</label>
                            <input type="text" placeholder="Masukkan nama pemilik..."
                                class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="pemilik" id="pemilik" required />
                        </div>
                    </div>

                    <div>
                        <label class="label-text font-semibold mb-2 block" for="alamat">Alamat Lengkap</label>
                        <textarea placeholder="Masukkan alamat lengkap..."
                            class="textarea textarea-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500" name="alamat"
                            id="alamat" rows="3" required></textarea>
                    </div>

                    <div>
                        <label class="label-text font-semibold mb-2 block" for="kontak">Kontak</label>
                        <input type="tel" placeholder="Masukkan nomor kontak..."
                            class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="kontak" id="kontak" required />
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

    @foreach ($bangunan as $item)
        <div id="edit-modal-{{ $item->id }}"
            class="overlay modal modal-middle hidden overlay-open:opacity-100 bg-black/70 overlay-open:duration-300"
            role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
                <form action="{{ route('bangunan.edit', ['id' => encrypt($item->id)]) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header bg-blue-200 rounded-t-md">
                        <h3 class="modal-title text-lg font-bold">Edit Data Bangunan</h3>
                        <button type="button" class="btn btn-text btn-circle btn-sm absolute inset-e-3 top-3"
                            aria-label="Close" data-overlay="#edit-modal-{{ $item->id }}">
                            <span class="icon-[tabler--x] size-5"></span>
                        </button>
                    </div>
                    <div class="modal-body space-y-4 p-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="label-text font-semibold mb-2 block"
                                    for="nomor_edit_{{ $item->id }}">Nomor Bangunan</label>
                                <input type="text" value="{{ $item->nomor }}" placeholder="Masukkan nomor..."
                                    class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    name="nomor" id="nomor_edit_{{ $item->id }}" required />
                            </div>
                            <div>
                                <label class="label-text font-semibold mb-2 block"
                                    for="blok_edit_{{ $item->id }}">Blok</label>
                                <input type="text" value="{{ $item->blok }}" placeholder="Masukkan blok..."
                                    class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    name="blok" id="blok_edit_{{ $item->id }}" required />
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="label-text font-semibold mb-2 block"
                                    for="tipe_bangunan_edit_{{ $item->id }}">Tipe Bangunan</label>
                                <select
                                    class="select select-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    name="tipe_bangunan" id="tipe_bangunan_edit_{{ $item->id }}" required>
                                    <option value="">Pilih tipe bangunan</option>
                                    @foreach ($tipebangunan as $tipe)
                                        <option value="{{ $tipe->id }}" @selected($tipe->id == $item->tipe_bangunan)>
                                            {{ $tipe->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="label-text font-semibold mb-2 block"
                                    for="pemilik_edit_{{ $item->id }}">Pemilik</label>
                                <input type="text" value="{{ $item->pemilik }}"
                                    placeholder="Masukkan nama pemilik..."
                                    class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    name="pemilik" id="pemilik_edit_{{ $item->id }}" required />
                            </div>
                        </div>

                        <div>
                            <label class="label-text font-semibold mb-2 block"
                                for="alamat_edit_{{ $item->id }}">Alamat Lengkap</label>
                            <textarea placeholder="Masukkan alamat lengkap..."
                                class="textarea textarea-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500" name="alamat"
                                id="alamat_edit_{{ $item->id }}" rows="3" required>{{ $item->alamat }}</textarea>
                        </div>

                        <div>
                            <label class="label-text font-semibold mb-2 block"
                                for="kontak_edit_{{ $item->id }}">Kontak</label>
                            <input type="tel" value="{{ $item->kontak }}" placeholder="Masukkan nomor kontak..."
                                class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="kontak" id="kontak_edit_{{ $item->id }}" required />
                        </div>
                    </div>
                    <div class="modal-footer border-t border-gray-200 pt-4">
                        <button type="button" class="btn btn-soft btn-secondary"
                            data-overlay="#edit-modal-{{ $item->id }}">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="delete-modal-{{ $item->id }}"
            class="overlay modal modal-middle hidden overlay-open:opacity-100 bg-black/70 overlay-open:duration-300"
            role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-sm modal-dialog-centered">
                <form action="{{ route('bangunan.hapus', ['id' => encrypt($item->id)])}}" method="POST" class="modal-content p-6 text-center">
                    @csrf
                    <div class="flex justify-center mb-4 text-error">
                        <span class="icon-[tabler--alert-triangle] size-14"></span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Konfirmasi Hapus</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Apakah Anda yakin ingin menghapus data bangunan
                        <strong>{{ $item->nama_bangunan }}</strong>? Data yang dihapus tidak dapat dikembalikan.
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
