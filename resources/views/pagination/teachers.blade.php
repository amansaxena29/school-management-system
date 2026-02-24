@if ($paginator->hasPages())
  <nav class="t-pagination" role="navigation" aria-label="Pagination Navigation">
    {{-- Prev --}}
    @if ($paginator->onFirstPage())
      <span class="t-page disabled">‹ Prev</span>
    @else
      <a class="t-page" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹ Prev</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
      {{-- "..." --}}
      @if (is_string($element))
        <span class="t-page dots">{{ $element }}</span>
      @endif

      {{-- Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <span class="t-page active">{{ $page }}</span>
          @else
            <a class="t-page" href="{{ $url }}">{{ $page }}</a>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
      <a class="t-page" href="{{ $paginator->nextPageUrl() }}" rel="next">Next ›</a>
    @else
      <span class="t-page disabled">Next ›</span>
    @endif
  </nav>
@endif
