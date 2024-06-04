@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div class="flex items-center justify-end">
            <div>
                <span class="relative z-0 inline-flex mt-2 shadow-sm lg:mt-0">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="relative inline-flex items-center px-2 py-2 text-base font-semibold leading-5 rounded-l dark:text-gray-400"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="relative inline-flex items-center px-2 py-2 text-base font-semibold leading-5 rounded-l dark:text-gray-400"
                            aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-semibold leading-5 text-main">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-semibold leading-5 bg-main text-white rounded">{{ $page }}</span>
                                    </span>
                                @elseif ($page == 1 || $page == $paginator->lastPage() || ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1))
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-semibold leading-5 transition text-main"
                                        aria-label="{{ __('pagination.goto_page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @elseif ($page == 2 && $paginator->currentPage() > 4)
                                    <span aria-disabled="true">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-semibold leading-5 text-main">...</span>
                                    </span>
                                @elseif ($page == $paginator->lastPage() - 1 && $paginator->currentPage() < $paginator->lastPage() - 3)
                                    <span aria-disabled="true">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-semibold leading-5 text-main">...</span>
                                    </span>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="relative inline-flex items-center px-2 py-2 text-base font-semibold leading-5 rounded-l dark:text-gray-400"
                            aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative inline-flex items-center px-2 py-2 text-base font-semibold leading-5 rounded-l dark:text-gray-400"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
