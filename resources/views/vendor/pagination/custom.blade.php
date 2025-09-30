@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center mt-4">
        <ul class="pagination" style="list-style:none; display:flex; gap:6px; padding:0; margin:0; flex-wrap: wrap;">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" style="padding:8px 14px; border:1px solid #ddd; border-radius:6px; color:#aaa;">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       style="padding:8px 14px; border:1px solid #ddd; border-radius:6px; color:#333; text-decoration:none; transition:0.2s;">
                        &lsaquo;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" style="padding:8px 14px; border:1px solid #ddd; border-radius:6px; color:#aaa;">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link" style="padding:8px 14px; border:1px solid #007bff; border-radius:6px; background:#007bff; color:#fff; font-weight:bold;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}"
                                   style="padding:8px 14px; border:1px solid #ddd; border-radius:6px; color:#333; text-decoration:none; transition:0.2s;"
                                   onmouseover="this.style.backgroundColor='#f8f9fa'"
                                   onmouseout="this.style.backgroundColor='transparent'">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                    style="padding:8px 14px; border:1px solid #ddd; border-radius:6px; color:#333; text-decoration:none; transition:0.2s;">
                        &rsaquo;
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" style="padding:8px 14px; border:1px solid #ddd; border-radius:6px; color:#aaa;">&rsaquo;</span>
                </li>
            @endif

        </ul>
    </nav>
@endif
