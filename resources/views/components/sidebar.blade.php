<aside id="layout-toggle"
    class="overlay overlay-open:translate-x-0 drawer drawer-start inset-y-0 start-0 hidden h-full [--auto-close:lg] sm:w-75 lg:z-50 lg:block lg:translate-x-0 lg:shadow-none"
    aria-label="Sidebar" tabindex="-1">
    <div class="drawer-body border-base-content/20 h-full border-e p-6">
        <button type="button" class="btn btn-text btn-square btn-xs absolute end-1 top-1 sm:hidden" aria-label="Close"
            data-overlay="#layout-toggle">
            <span class="icon-[tabler--x] size-4"></span>
        </button>
        <div class="flex flex-col h-full">
            <header class="flex items-center gap-3 mb-6">
                <a href="#" class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Sistem RT') }} logo"
                        class="h-10 w-10 rounded-md object-cover">
                    <div>
                        <div class="text-lg font-semibold leading-tight">{{ config('app.name', 'Sistem RT') }}</div>
                        <div class="text-xs text-base-content/60">Administrator</div>
                    </div>
                </a>
            </header>

            <nav class="flex-1 overflow-auto">
                <ul class="menu menu-vertical">
                    <li>
                        <a href="#" class="flex items-center gap-3 px-3 py-2">
                            <span class="icon-[tabler--layout-dashboard] size-5" aria-hidden="true"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center gap-3 px-3 py-2">
                            <span class="icon-[tabler--users] size-5" aria-hidden="true"></span>
                            <span>Data Kependudukan</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center gap-3 px-3 py-2">
                            <span class="icon-[tabler--file-description] size-5" aria-hidden="true"></span>
                            <span>Administrasi & Surat</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center gap-3 px-3 py-2">
                            <span class="icon-[tabler--wallet] size-5" aria-hidden="true"></span>
                            <span>Keuangan (Kas RT)</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center gap-3 px-3 py-2">
                            <span class="icon-[tabler--heart-handshake] size-5" aria-hidden="true"></span>
                            <span>Bansos & Kesehatan</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center gap-3 px-3 py-2">
                            <span class="icon-[tabler--calendar-event] size-5" aria-hidden="true"></span>
                            <span>Informasi & Kegiatan</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center gap-3 px-3 py-2">
                            <span class="icon-[tabler--settings] size-5" aria-hidden="true"></span>
                            <span>Pengaturan Sistem</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
