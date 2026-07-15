<x-app-layout :title="$title" :subtitle="$subtitle ?? ''">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div x-data="{
        activeTab: 'foto',
        isEditModalOpen: false,
        isPhotoModalOpen: false,
        slideShowOpen: false,
        currentSlide: ''
    }" class="px-2 md:px-0 w-full max-w-7xl mx-auto space-y-6 pb-10">

        <div
            class="bg-linear-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>

            <div class="relative z-10">
                <h2 class="text-blue-100 text-sm font-bold uppercase tracking-wider mb-1">Detail Bangunan</h2>
                <h1 class="text-white text-2xl md:text-3xl font-extrabold">{{ $bangunan->blok . '-' . $bangunan->nomor }}
                    ({{ $bangunan->tipe_bangunan }})
                </h1>
            </div>

            <div class="relative z-10 flex gap-2">
                <button
                    @click="isEditModalOpen = true; $nextTick(() => window.dispatchEvent(new CustomEvent('bangunan-edit-open')))"
                    class="btn bg-white/20 hover:bg-white/30 text-white border-none backdrop-blur-sm shadow-sm rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit Lokasi
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div
                class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="p-5 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Peta Lokasi
                    </h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-md">Peta preview (ubah koordinat
                        via modal)</span>
                </div>

                <div id="map-bangunan" class="h-100 w-full z-0" data-lat="{{ $bangunan->latitude ?? -4.507976 }}"
                    data-lng="{{ $bangunan->longitude ?? 140.5371094 }}">
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Detail
                </h3>

                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Alamat
                            Lengkap</span>
                        <span class="text-gray-800 font-medium">{{ $bangunan->alamat }}</span>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <span
                            class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pemilik</span>
                        <span class="text-gray-800 font-medium leading-relaxed">{{ $bangunan->pemilik }}</span>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <span
                            class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kontak</span>
                        <span class="text-gray-800 font-medium leading-relaxed">{{ $bangunan->kontak }}</span>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Titik
                            Koordinat</span>
                        <div class="flex items-center gap-2 mt-1">
                            <span
                                class="font-mono text-sm text-blue-600 bg-blue-50 px-2 py-1 rounded">{{ $bangunan->latitude }}</span>
                            <span class="text-gray-400">,</span>
                            <span
                                class="font-mono text-sm text-blue-600 bg-blue-50 px-2 py-1 rounded">{{ $bangunan->longitude }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex border-b border-gray-100">
                <button @click="activeTab = 'foto'"
                    :class="activeTab === 'foto' ? 'border-blue-500 text-blue-600 bg-blue-50/50' :
                        'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="flex-1 md:flex-none px-6 py-4 border-b-2 font-semibold text-sm transition-colors duration-200">
                    Galeri Foto
                </button>
                <button @click="activeTab = 'riwayat'"
                    :class="activeTab === 'riwayat' ? 'border-blue-500 text-blue-600 bg-blue-50/50' :
                        'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="flex-1 md:flex-none px-6 py-4 border-b-2 font-semibold text-sm transition-colors duration-200">
                    Riwayat Tinggal
                </button>
            </div>

            <div x-show="activeTab === 'foto'" x-transition.opacity.duration.300ms class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800">Galeri Bangunan</h3>
                    <button @click="isPhotoModalOpen = true" class="btn btn-sm btn-primary rounded-lg shadow-sm">
                        <i class="fas fa-plus"></i> Tambah Foto
                    </button>
                </div>

                @if ($fotobangunan->count())
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                        @foreach ($fotobangunan as $foto)
                            <div
                                class="relative group rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 bg-gray-100">
                                <img src="{{ asset('storage/' . $foto->foto) }}"
                                    class="h-48 w-full object-cover cursor-pointer transform group-hover:scale-105 transition duration-500"
                                    @click="currentSlide = '{{ asset('storage/' . $foto->foto) }}'; slideShowOpen = true">

                                <form method="POST"
                                    action="{{ route('bangunan.foto.hapus', ['id' => encrypt($foto->id)]) }}"
                                    class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @csrf
                                    <button class="btn btn-sm btn-circle btn-error shadow-lg"
                                        onclick="return confirm('Hapus foto secara permanen?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-gray-200" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p>Belum ada foto untuk bangunan ini.</p>
                    </div>
                @endif
            </div>

            <div x-show="activeTab === 'riwayat'" x-cloak x-transition.opacity.duration.300ms class="p-6">
                @if ($riwayattinggal->count())
                    <div class="relative border-l-2 border-blue-100 ml-3 md:ml-4 space-y-8 py-4">
                        @foreach ($riwayattinggal as $r)
                            <div class="relative pl-6 md:pl-8">
                                <div
                                    class="absolute -left-2.25 top-1.5 w-4 h-4 bg-blue-500 rounded-full border-4 border-white shadow">
                                </div>

                                <div
                                    class="bg-gray-50 p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                    <div
                                        class="flex flex-col md:flex-row md:justify-between md:items-center mb-2 gap-2">
                                        <h4 class="font-bold text-gray-800 text-lg">{{ $r->nama }}</h4>
                                        <span
                                            class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-semibold">
                                            {{ $r->tanggal_mulai_tinggal }} — {{ $r->tanggal_akhir_tinggal }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600">{{ $r->keterangan }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-gray-200" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>Belum ada riwayat tinggal.</p>
                    </div>
                @endif
            </div>
        </div>

        <template x-teleport="body">
            <div x-show="isEditModalOpen" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">

                    <div x-show="isEditModalOpen" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-sm"
                        @click="isEditModalOpen = false"></div>

                    <div x-show="isEditModalOpen" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative inline-block w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl sm:my-8">

                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-lg font-bold text-gray-900">Simpan Koordinat Baru</h3>
                            <button @click="isEditModalOpen = false"
                                class="text-gray-400 hover:text-gray-600 transition-colors">&times;</button>
                        </div>

                        <p class="text-sm text-gray-500 mb-4">Koordinat bisa diubah dengan menggeser pin pada peta atau
                            mengisi input Latitude/Longitude di bawah.</p>

                        <div id="map-bangunan-modal" class="h-70 w-full rounded-xl border border-gray-200 mb-4">
                        </div>

                        <form method="POST"
                            action="{{ route('bangunan.setlokasi', ['id' => encrypt($bangunan->id)]) }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Latitude</label>
                                    <input id="inputLat" name="latitude" value="{{ $bangunan->latitude }}"
                                        class="input input-bordered w-full bg-gray-50" type="number" step="any"
                                        inputmode="decimal">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Longitude</label>
                                    <input id="inputLng" name="longitude" value="{{ $bangunan->longitude }}"
                                        class="input input-bordered w-full bg-gray-50" type="number" step="any"
                                        inputmode="decimal">
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" class="btn btn-ghost"
                                    @click="isEditModalOpen = false">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>

        <template x-teleport="body">
            <div x-show="isPhotoModalOpen" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
                <div class="flex items-center justify-center min-h-screen px-4">

                    <div x-show="isPhotoModalOpen" x-transition.opacity
                        class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="isPhotoModalOpen = false"></div>

                    <div x-show="isPhotoModalOpen" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="relative bg-white w-full max-w-md p-6 rounded-2xl shadow-2xl">

                        <h3 class="text-lg font-bold text-gray-900 mb-4">Upload Foto Bangunan</h3>

                        <form method="POST" action="{{ route('bangunan.foto.tambah') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="bangunan_id" value="{{ $bangunan->id }}">

                            <div class="form-control w-full">
                                <label class="label"><span class="label-text font-semibold">Pilih File
                                        Foto</span></label>
                                <input type="file" name="foto"
                                    class="file-input file-input-bordered file-input-primary w-full" required
                                    accept="image/*">
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" class="btn btn-ghost"
                                    @click="isPhotoModalOpen = false">Batal</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>

        <template x-teleport="body">
            <div x-show="slideShowOpen" class="fixed inset-0 z-100 flex items-center justify-center" x-cloak
                @keydown.escape.window="slideShowOpen = false">
                <div x-show="slideShowOpen" x-transition.opacity.duration.300ms
                    class="absolute inset-0 bg-black/90 backdrop-blur-md" @click="slideShowOpen = false"></div>

                <button @click="slideShowOpen = false"
                    class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <img x-show="slideShowOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    :src="currentSlide"
                    class="relative z-10 max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-2xl">
            </div>
        </template>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.getElementById('map-bangunan');
            if (!el) return;

            const lat = parseFloat(el.dataset.lat);
            const lng = parseFloat(el.dataset.lng);
            const defaultLat = Number.isFinite(lat) ? lat : -4.507976;
            const defaultLng = Number.isFinite(lng) ? lng : 140.5371094;

            const inputLat = document.getElementById('inputLat');
            const inputLng = document.getElementById('inputLng');

            const map = L.map(el, {
                dragging: false,
                touchZoom: false,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                boxZoom: false,
                keyboard: false,
                zoomControl: false
            }).setView([defaultLat, defaultLng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker([defaultLat, defaultLng], {
                draggable: false,
                interactive: false
            }).addTo(map);

            let editMap = null;
            let editMarker = null;

            function updateInputs(position) {
                if (inputLat && inputLng) {
                    inputLat.value = Number(position.lat).toFixed(8);
                    inputLng.value = Number(position.lng).toFixed(8);
                }
            }

            function getInputPositionOrDefault() {
                const parsedLat = parseFloat(inputLat?.value ?? '');
                const parsedLng = parseFloat(inputLng?.value ?? '');

                if (Number.isFinite(parsedLat) && Number.isFinite(parsedLng)) {
                    return L.latLng(parsedLat, parsedLng);
                }

                return L.latLng(defaultLat, defaultLng);
            }

            function syncPreviewMap(position) {
                marker.setLatLng(position);
                map.setView(position, map.getZoom(), {
                    animate: false
                });
            }

            function updateMarkerFromInputs() {
                if (!inputLat || !inputLng) return;

                const nextLat = parseFloat(inputLat.value);
                const nextLng = parseFloat(inputLng.value);

                if (!Number.isFinite(nextLat) || !Number.isFinite(nextLng)) return;

                const nextPos = L.latLng(nextLat, nextLng);
                syncPreviewMap(nextPos);

                if (editMap && editMarker) {
                    editMarker.setLatLng(nextPos);
                    editMap.setView(nextPos, editMap.getZoom(), {
                        animate: false
                    });
                }
            }

            function ensureEditMap() {
                const modalMapEl = document.getElementById('map-bangunan-modal');
                if (!modalMapEl) return;

                const initialPos = getInputPositionOrDefault();

                if (!editMap) {
                    editMap = L.map(modalMapEl).setView(initialPos, 15);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(editMap);

                    editMarker = L.marker(initialPos, {
                        draggable: true
                    }).addTo(editMap);

                    editMap.on('click', e => {
                        editMarker.setLatLng(e.latlng);
                        updateInputs(e.latlng);
                        syncPreviewMap(e.latlng);
                    });

                    editMarker.on('dragend', () => {
                        const pos = editMarker.getLatLng();
                        updateInputs(pos);
                        syncPreviewMap(pos);
                    });
                } else {
                    editMarker.setLatLng(initialPos);
                    editMap.setView(initialPos, editMap.getZoom(), {
                        animate: false
                    });
                }

                setTimeout(() => {
                    editMap.invalidateSize();
                }, 150);
            }

            window.addEventListener('bangunan-edit-open', ensureEditMap);

            if (inputLat && inputLng) {
                inputLat.addEventListener('input', updateMarkerFromInputs);
                inputLng.addEventListener('input', updateMarkerFromInputs);
                inputLat.addEventListener('change', updateMarkerFromInputs);
                inputLng.addEventListener('change', updateMarkerFromInputs);
            }

            const initialPos = getInputPositionOrDefault();
            updateInputs(initialPos);
            syncPreviewMap(initialPos);
        });
    </script>
</x-app-layout>
