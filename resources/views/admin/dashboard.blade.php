<x-app-layout :title="'Dashboard RT Interaktif'">
    <div class="min-h-screen bg-slate-50 p-6 font-sans">

        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Dashboard Rukun Tetangga</h1>
                <p class="text-slate-500 mt-1">Ringkasan data kependudukan dan operasional RT hari ini.</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-slate-600">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
                <span
                    class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 mt-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Sistem Berjalan Normal
                </span>
            </div>
        </div>

        <!-- 1. Top Metrics (Demografi Utama) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <!-- Warga -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Warga</p>
                        <h2 class="text-3xl font-black text-slate-800 mt-2">{{ $warga['total'] }} <span
                                class="text-sm font-normal text-slate-400">Jiwa</span></h2>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-emerald-600 font-medium mt-4">{{ $warga['trend'] }}</p>
            </div>

            <!-- KK -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Kepala Keluarga</p>
                        <h2 class="text-3xl font-black text-slate-800 mt-2">{{ $kk['total'] }} <span
                                class="text-sm font-normal text-slate-400">KK</span></h2>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-emerald-600 font-medium mt-4">{{ $kk['trend'] }}</p>
            </div>

            <!-- Lansia -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Warga Lansia</p>
                        <h2 class="text-3xl font-black text-slate-800 mt-2">{{ $lansia['total'] }} <span
                                class="text-sm font-normal text-slate-400">Jiwa</span></h2>
                    </div>
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-slate-500 font-medium mt-4">{{ $lansia['percent'] }} (Perhatian Khusus)</p>
            </div>

            <!-- JKN -->
            <div
                class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 shadow-md relative overflow-hidden text-white">
                <div class="absolute right-0 top-0 opacity-10">
                    <svg class="w-32 h-32 -mt-4 -mr-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-sm font-medium opacity-90">Tercover JKN / BPJS</p>
                        <h2 class="text-3xl font-black mt-2">{{ $jkn['total'] }} <span
                                class="text-sm font-normal opacity-80">Jiwa</span></h2>
                    </div>
                </div>
                <p class="text-xs font-semibold mt-4 bg-white/20 inline-block px-2 py-1 rounded">{{ $jkn['percent'] }}
                </p>
            </div>
        </div>

        <!-- 2. Operasional & Keuangan -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            <!-- Keuangan Kas -->
            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 lg:col-span-2 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Kas RT & Operasional</h3>
                    <p class="text-sm text-slate-500 mb-6">Transparansi dana warga bulan ini</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-5 rounded-2xl bg-gradient-to-r from-slate-800 to-slate-900 text-white">
                        <p class="text-sm opacity-80 mb-1">Saldo Kas Tersedia</p>
                        <h4 class="text-3xl font-bold">Rp {{ number_format($keuangan['saldo'], 0, ',', '.') }}</h4>
                    </div>
                    <div class="p-5 rounded-2xl bg-rose-50 border border-rose-100 text-rose-900">
                        <p class="text-sm opacity-80 mb-1 text-rose-600">Pengeluaran Bulan Ini</p>
                        <h4 class="text-3xl font-bold">Rp
                            {{ number_format($keuangan['pengeluaran_bulan_ini'], 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>

            <!-- Action Cards (Surat & Bantuan) -->
            <div class="space-y-6">
                <!-- Permohonan Surat -->
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center text-rose-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-800 font-bold">Permohonan Surat</p>
                            <p class="text-sm text-slate-500">Menunggu verifikasi</p>
                        </div>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-rose-600 text-white flex items-center justify-center font-bold shadow-md">
                        {{ $permohonan_surat }}
                    </div>
                </div>

                <!-- Program Pemerintah -->
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-800 font-bold">Program Pemerintah</p>
                            <p class="text-sm text-slate-500">Penerima PKH/BPNT</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <h4 class="text-2xl font-black text-slate-800">{{ $bantuan_pemerintah }} <span
                                class="text-xs font-normal text-slate-500">KK</span></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Kegiatan Terdekat -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Kegiatan Terjadwal</h3>
                <button class="text-sm text-blue-600 font-semibold hover:text-blue-700">Lihat Semua</button>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach ($kegiatan_aktif as $kegiatan)
                    <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-2 h-10 bg-blue-500 rounded-full"></div>
                            <div>
                                <h4 class="font-bold text-slate-800">{{ $kegiatan['nama'] }}</h4>
                                <p class="text-sm text-slate-500 flex items-center gap-1 mt-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $kegiatan['tanggal'] }}
                                </p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600">
                            {{ $kegiatan['status'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <h3 class="text-xl font-bold text-slate-800 mb-4 mt-8">Statistik & Analitik</h3>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col items-center">
                <h4 class="text-sm font-bold text-slate-600 mb-4 self-start">Demografi Usia Warga</h4>
                <div id="umurChart" class="w-full"></div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <h4 class="text-sm font-bold text-slate-600 mb-4">Status Ekonomi Keluarga</h4>
                <div id="ekonomiChart" class="w-full"></div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <h4 class="text-sm font-bold text-slate-600 mb-4">Tren Pemasukan Kas (6 Bulan)</h4>
                <div id="kasChart" class="w-full"></div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fontFamily = "'Inter', 'sans-serif'";
                const umurOptions = {
                    series: @json($chart_umur['data']),
                    labels: @json($chart_umur['labels']),
                    chart: {
                        type: 'donut',
                        height: 300,
                        fontFamily: fontFamily,
                    },
                    colors: ['#3b82f6', '#10b981', '#f59e0b', '#6366f1', '#ef4444'],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    name: {
                                        show: true
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '24px',
                                        fontWeight: 'bold',
                                        color: '#1e293b'
                                    },
                                    total: {
                                        show: true,
                                        showAlways: true,
                                        label: 'Total Warga',
                                        color: '#64748b'
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        position: 'bottom'
                    }
                };
                new ApexCharts(document.querySelector("#umurChart"), umurOptions).render();

                const ekonomiOptions = {
                    series: [{
                        name: 'Jumlah Jiwa',
                        data: @json($chart_ekonomi['data'])
                    }],
                    chart: {
                        type: 'bar',
                        height: 280,
                        fontFamily: fontFamily,
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#0ea5e9'],
                    plotOptions: {
                        bar: {
                            borderRadius: 6,
                            columnWidth: '45%',
                            distributed: true
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: @json($chart_ekonomi['labels']),
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#64748b'
                            }
                        }
                    },
                    grid: {
                        borderColor: '#f1f5f9',
                        strokeDashArray: 4, // Garis putus-putus
                        xaxis: {
                            lines: {
                                show: false
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                };
                new ApexCharts(document.querySelector("#ekonomiChart"), ekonomiOptions).render();

                const kasOptions = {
                    series: [{
                        name: 'Pemasukan (Rp)',
                        data: @json($chart_kas['data'])
                    }],
                    chart: {
                        type: 'area',
                        height: 280,
                        fontFamily: fontFamily,
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#10b981'], // emerald-500
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.4,
                            opacityTo: 0.05,
                            stops: [0, 90, 100]
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    xaxis: {
                        categories: @json($chart_kas['labels']),
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#64748b'
                            },
                            formatter: function(value) {
                                return 'Rp ' + (value / 1000000) + ' Jt';
                            }
                        }
                    },
                    grid: {
                        borderColor: '#f1f5f9',
                        strokeDashArray: 4,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: true
                            }
                        },
                    }
                };
                new ApexCharts(document.querySelector("#kasChart"), kasOptions).render();
            });
        </script>

    </div>
</x-app-layout>
