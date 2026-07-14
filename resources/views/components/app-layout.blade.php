@props(['title' => '', 'subtitle' => '', 'active' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '' ? $title . ' - ' : '' }}{{ config('app.name') }}</title>
    @if (isset($meta))
        {{ $meta }}
    @endif

    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">
    <div class="flex min-h-screen bg-slate-50 flex-col">
        @include('components.header', ['active' => $active])
        @include('components.sidebar', ['active' => $active])
        <div class="flex grow flex-col lg:ps-75">
            <nav class="flex px-4 py-3" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-blue-600">
                                <svg class="w-3 h-3 me-2.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Home
                            </a>
                        </li>
                        @if ($title)
                            <li>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400 mx-2"></i>
                                    <span class="text-sm font-medium text-slate-600">{{ $title }}</span>
                                </div>
                            </li>
                        @endif
                        @if ($subtitle)
                            <li>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400 mx-2"></i>
                                    <span class="text-sm font-semibold text-slate-900">{{ $subtitle }}</span>
                                </div>
                            </li>
                        @endif
                    </ol>
                </nav>
            <main class="mx-auto w-full flex-1 p-4">
                {{ $slot }}
            </main>
            @include('components.footer')
        </div>
    </div>
</body>

</html>

@include('sweetalert::alert')
