<x-app-layout :title="$title" :active="$active" :subtitle="$subtitle ?? ''">
    <div class="card bg-white border border-base-200 shadow-sm p-6">
        <div class="mb-6">
            <h3 class="text-xl font-semibold">Master Data Kabupaten / Kota</h3>
            <p class="text-sm text-base-content/60">
                Kelola daftar Kabupaten / Kota
            </p>
        </div>

        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
            <div class="flex items-center gap-2">
                <button type="button" class="btn btn-success" aria-haspopup="dialog" aria-expanded="false"
                    aria-controls="sync-kabkota-modal" data-overlay="#sync-kabkota-modal">
                    <span class="icon-[tabler--refresh]"></span>
                    Sync Data
                </button>
            </div>


            <form id="searchForm" action="{{ route('datawilayah.kabkota') }}" method="GET">
                <div class="relative w-full">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                        placeholder="Cari kabupaten/kota..." class="input input-bordered w-full pl-10" id="searchInput">
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
                <thead class="bg-base-100 text-sm">
                    <tr>
                        <th class="py-4 text-center w-12">No</th>
                        <th class="py-4 text-center">Kode Kabupaten/Kota</th>
                        <th class="py-4">Nama Kabupaten/Kota</th>
                        <th class="py-4">Provinsi</th>
                        <th class="py-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kabkota as $item)
                        <tr class="row-hover">
                            <td class="w-12 text-center">{{ $loop->iteration }}</td>
                            <td class="font-bold text-center">{{ $item->code }}</td>
                            <td class="py-2">{{ $item->name_kabkota }}</td>
                            <td class="py-2">{{ $item->name_provinsi }}</td>
                            <td><a href="{{ route('datawilayah.kecamatan', ['search' => $item->code]) }}"
                                    class="btn btn-text" title="Lihat Kecamatan"><i
                                        class="fa-solid fa-map-location-dot text-green-500"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

         <div class="p-4">
            @if(method_exists($kabkota, 'links'))
                {{ $kabkota->appends(['search' => request('search')])->links() }}
            @endif
        </div>

    </div>

    <div id="sync-kabkota-modal"
        class="overlay modal modal-middle hidden overlay-open:opacity-100 bg-black/70 overlay-open:duration-300"
        role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-sm modal-dialog-centered">
            <form id="syncKabkotaForm" action="{{ route('datawilayah.sync.kabkota') }}" method="POST"
                class="modal-content" aria-describedby="sync-kabkota-desc">
                @csrf
                <div class="modal-header bg-yellow-100 rounded-t-md flex items-center gap-3">
                    <div>
                        <h3 class="modal-title text-lg font-bold">Sync Data Kabupaten/Kota</h3>

                    </div>

                    <button type="button" class="btn btn-text btn-circle btn-sm absolute inset-e-3 top-3"
                        aria-label="Close" data-overlay="#sync-kabkota-modal">
                        <span class="icon-[tabler--x] size-5"></span>
                    </button>
                </div>

                <div id="sync-kabkota-desc" class="modal-body p-6">
                    <div class="flex items-start gap-4">
                        <div>
                            <p class="text-sm font-medium mb-2">Anda akan melakukan sinkronisasi data kabupaten/kota.
                            </p>
                            <p class="text-sm text-base-content/60 mb-3">Proses ini akan mengambil data dari sumber
                                resmi dan memperbarui entri di sistem. Proses dapat memakan waktu beberapa saat.</p>

                            <ul class="text-xs text-base-content/60 list-disc pl-5 space-y-1">
                                <li>Data lama akan diperbarui jika ada perubahan.</li>
                                <li>Proses ini tidak menghapus data terkait lainnya.</li>
                                <li>Jangan tutup jendela sampai proses selesai.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-t border-gray-200 pt-4 flex justify-end gap-2">
                    <button id="syncKabkotaCancel" type="button" class="btn btn-soft btn-secondary"
                        data-overlay="#sync-kabkota-modal">Batal</button>
                    <button id="syncKabkotaSubmit" type="submit" class="btn btn-primary" aria-busy="false">
                        <span class="inline-flex items-center gap-2">
                            <span class="hidden" id="syncKabkotaSpinner"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <circle cx="12" cy="12" r="10" stroke-width="4" class="opacity-25">
                                    </circle>
                                    <path d="M4 12a8 8 0 018-8" stroke-width="4" stroke-linecap="round"
                                        class="opacity-75"></path>
                                </svg></span>
                            <span id="syncKabkotaLabel">Ya, ambil data</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const form = document.getElementById('syncKabkotaForm');
            if (!form) return;

            const submitBtn = document.getElementById('syncKabkotaSubmit');
            const cancelBtn = document.getElementById('syncKabkotaCancel');
            const spinner = document.getElementById('syncKabkotaSpinner');
            const label = document.getElementById('syncKabkotaLabel');

            form.addEventListener('submit', function() {
                submitBtn.setAttribute('disabled', 'disabled');
                cancelBtn.setAttribute('disabled', 'disabled');
                submitBtn.setAttribute('aria-busy', 'true');
                if (spinner) spinner.classList.remove('hidden');
                if (label) label.textContent = 'Menyinkronkan...';
            });
        })();
    </script>

</x-app-layout>
