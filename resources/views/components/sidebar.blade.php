<aside id="layout-toggle"
    class="overlay overlay-open:translate-x-0 drawer drawer-start inset-y-0 start-0 hidden h-full sm:w-75 lg:z-50 lg:block lg:translate-x-0 bg-base-100 border-r border-base-content/10">

    <div class="drawer-body h-full p-5 flex flex-col">

        <!-- CLOSE BUTTON MOBILE -->
        <button type="button" class="btn btn-ghost btn-sm btn-circle absolute end-2 top-2 sm:hidden"
            data-overlay="#layout-toggle">
            <i class="fas fa-times"></i>
        </button>

        <!-- HEADER -->
        <header class="flex items-center gap-3 mb-8">
            <img src="{{ asset('assets/images/logo.png') }}" class="h-11 w-11 rounded-xl shadow object-cover">

            <div>
                <div class="text-lg font-semibold leading-tight">
                    {{ config('app.name', 'Sistem RT') }}
                </div>
                <div class="text-xs text-base-content/60">
                    Administrator
                </div>
            </div>
        </header>

        <!-- MENU -->
        <nav class="flex-1 overflow-y-auto pr-1">
            <ul class="menu menu-vertical gap-1 text-sm">

                <!-- DASHBOARD -->
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-base-200 transition">
                        <i class="fas fa-chart-line w-5 text-center"></i>
                        Dashboard
                    </a>
                </li>

                <!-- BANGUNAN -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-base-200 transition">

                        <div class="flex items-center gap-3">
                            <i class="fas fa-building w-5 text-center"></i>
                            Bangunan
                        </div>

                        <i :class="open ? 'rotate-90' : ''"
                            class="fas fa-chevron-right text-xs transition-transform"></i>
                    </button>

                    <ul x-show="open" x-transition x-cloak class="ml-6 mt-1 space-y-1 text-base-content/80">

                        <li>
                            <a href="{{ route('bangunan')}}" class="block px-3 py-2 rounded-md hover:bg-base-200 transition">
                                Data Bangunan
                            </a>
                        </li>

                        <li>
                            <a href="#" class="block px-3 py-2 rounded-md hover:bg-base-200 transition">
                                Peta Bangunan
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- KELUARGA DAN WARGA -->
                <li x-data="{ open: @json(request()->routeIs('penduduk.*')) }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-base-200 transition {{ request()->routeIs('penduduk.*') ? 'bg-base-200' : '' }}">

                        <div class="flex items-center gap-3">
                            <i class="fas fa-users w-5 text-center"></i>
                            Data Kependudukan
                        </div>

                        <i :class="open ? 'rotate-90' : ''"
                            class="fas fa-chevron-right text-xs transition-transform"></i>
                    </button>

                    <ul x-show="open" x-transition x-cloak class="ml-6 mt-1 space-y-1 text-base-content/80">

                        <li>
                            <a href="{{ route('penduduk.keluarga') }}"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('penduduk.keluarga') ? 'bg-base-200 font-semibold' : '' }}">
                                Data Keluarga
                            </a>
                        </li>

                        <li>
                            <a href="#"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('penduduk.warga') ? 'bg-base-200 font-semibold' : '' }}">
                                Data Warga
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ADMIN -->
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-base-200 transition">
                        <i class="fas fa-file w-5 text-center"></i>
                        Administrasi & Surat
                    </a>
                </li>

                <!-- KEUANGAN -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-base-200 transition">

                        <div class="flex items-center gap-3">
                            <i class="fas fa-coins w-5 text-center"></i>
                            Keuangan
                        </div>

                        <i :class="open ? 'rotate-90' : ''"
                            class="fas fa-chevron-right text-xs transition-transform"></i>
                    </button>

                    <ul x-show="open" x-transition x-cloak class="ml-6 mt-1 space-y-1 text-base-content/80">

                        <li>
                            <a href="#" class="block px-3 py-2 rounded-md hover:bg-base-200 transition">
                                Besaran Iuran
                            </a>
                        </li>

                        <li>
                            <a href="#" class="block px-3 py-2 rounded-md hover:bg-base-200 transition">
                                Iuran
                            </a>
                        </li>

                        <li>
                            <a href="#" class="block px-3 py-2 rounded-md hover:bg-base-200 transition">
                                Saldo Warga
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- BPJS -->
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-base-200 transition">
                        <i class="fas fa-shield-alt w-5 text-center"></i>
                        BPJS
                    </a>
                </li>

                <!-- PROGRAM -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-base-200 transition">

                        <div class="flex items-center gap-3">
                            <i class="fas fa-hands-helping w-5 text-center"></i>
                            Program Bantuan
                        </div>

                        <i :class="open ? 'rotate-90' : ''"
                            class="fas fa-chevron-right text-xs transition-transform"></i>
                    </button>

                    <ul x-show="open" x-transition x-cloak class="ml-6 mt-1 space-y-1 text-base-content/80">

                        <li>
                            <a href="#" class="block px-3 py-2 rounded-md hover:bg-base-200 transition">
                                Program
                            </a>
                        </li>

                        <li>
                            <a href="#" class="block px-3 py-2 rounded-md hover:bg-base-200 transition">
                                Rekap Program
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- KEGIATAN -->
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-base-200 transition">
                        <i class="fas fa-calendar-check w-5 text-center"></i>
                        Informasi & Kegiatan
                    </a>
                </li>

                <!-- SETTINGS -->
                <li x-data="{ open: @json(request()->routeIs('datawilayah.*')) }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-base-200 transition {{ request()->routeIs('datawilayah.*') ? 'bg-base-200' : '' }}">

                        <div class="flex items-center gap-3">
                            <i class="fas fa-cogs w-5 text-center"></i>
                            Pengaturan Sistem
                        </div>

                        <i :class="open ? 'rotate-90' : ''"
                            class="fas fa-chevron-right text-xs transition-transform"></i>
                    </button>

                    <ul x-show="open" x-transition x-cloak class="ml-6 mt-1 space-y-1 text-base-content/80">
                        <li>
                            <a href="#"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('users*') ? 'bg-base-200 font-semibold' : '' }}">
                                <i class="fas fa-user w-4 text-center mr-2"></i>
                                Users
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('datawilayah.provinsi') }}"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('datawilayah.provinsi') ? 'bg-base-200 font-semibold' : '' }}">
                                <i class="fas fa-flag w-4 text-center mr-2"></i>
                                Data Provinsi
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('datawilayah.kabkota') }}"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('datawilayah.kabkota') ? 'bg-base-200 font-semibold' : '' }}">
                                <i class="fas fa-city w-4 text-center mr-2"></i>
                                Data Kabupaten/Kota
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('datawilayah.kecamatan') }}"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('datawilayah.kecamatan') ? 'bg-base-200 font-semibold' : '' }}">
                                <i class="fas fa-map-signs w-4 text-center mr-2"></i>
                                Data Kecamatan
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('datawilayah.kelurahan') }}"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('datawilayah.kelurahan') ? 'bg-base-200 font-semibold' : '' }}">
                                <i class="fas fa-home w-4 text-center mr-2"></i>
                                Data Kelurahan/Desa
                            </a>
                        </li>

                        <li>
                            <a href="#"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('app*') ? 'bg-base-200 font-semibold' : '' }}">
                                <i class="fas fa-tools w-4 text-center mr-2"></i>
                                App
                            </a>
                        </li>

                        <li>
                            <a href="#"
                                class="block px-3 py-2 rounded-md hover:bg-base-200 transition {{ request()->routeIs('pejabat*') ? 'bg-base-200 font-semibold' : '' }}">
                                <i class="fas fa-user-tie w-4 text-center mr-2"></i>
                                Pejabat
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

    </div>
</aside>
