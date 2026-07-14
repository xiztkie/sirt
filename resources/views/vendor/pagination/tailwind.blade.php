@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        <div class="flex gap-2 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="btn btn-soft btn-primary text-blue-400 bg-blue-50 opacity-60 cursor-not-allowed">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-soft btn-primary text-blue-600 bg-white hover:bg-blue-50">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-soft btn-primary text-blue-600 bg-white hover:bg-blue-50">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="btn btn-soft btn-primary text-blue-400 bg-blue-50 opacity-60 cursor-not-allowed">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        <div class="hidden sm:flex-1 sm:flex sm:gap-2 sm:items-center sm:justify-between">

            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-600">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="inline-flex rtl:flex-row-reverse items-center gap-1  p-1 bg-white dark:bg-gray-800">

                    {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="btn btn-text text-blue-400 bg-blue-50 opacity-60 cursor-not-allowed rounded-l-md" aria-hidden="true">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-soft btn-primary text-blue-600 bg-white hover:bg-blue-50 rounded-l-md" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements: first 2, middle 3 (around current), last 2 --}}
                    @php
                        $total = method_exists($paginator, 'lastPage') ? $paginator->lastPage() : (int) ceil($paginator->total() / $paginator->perPage());
                        $current = $paginator->currentPage();
                        $left = 2; $middle = 3; $right = 2;

                        $pagesToShow = [];

                        // first block
                        for ($i = 1; $i <= min($left, $total); $i++) {
                            $pagesToShow[$i] = true;
                        }

                        // middle block centered on current
                        $half = intdiv($middle, 2);
                        $start = max(1, $current - $half);
                        $end = min($total, $current + $half);
                        for ($i = $start; $i <= $end; $i++) {
                            $pagesToShow[$i] = true;
                        }

                        // last block
                        for ($i = max(1, $total - $right + 1); $i <= $total; $i++) {
                            $pagesToShow[$i] = true;
                        }

                        $pages = array_keys($pagesToShow);
                        sort($pages);
                        $prev = 0;
                    @endphp

                    @foreach ($pages as $page)
                        @if ($prev && $page - $prev > 1)
                            {{-- gap, show ellipsis --}}
                            <span aria-disabled="true">
                                <span class="btn btn-soft btn-primary text-blue-600 bg-white cursor-default px-3">&hellip;</span>
                            </span>
                        @endif

                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span class="btn btn-soft btn-primary bg-blue-600 text-white shadow">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $paginator->url($page) }}" class="btn btn-soft btn-primary text-blue-600 bg-white hover:bg-blue-50" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif

                        @php $prev = $page; @endphp
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-soft btn-primary text-blue-600 bg-white hover:bg-blue-50 rounded-r-md" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="btn btn-soft btn-primary text-blue-400 bg-blue-50 opacity-60 cursor-not-allowed rounded-r-md" aria-hidden="true">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
