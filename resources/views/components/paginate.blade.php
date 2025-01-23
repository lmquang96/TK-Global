<nav aria-label="Page navigation">
  <ul class="pagination">
    @if (!$paginator->onFirstPage())
    <li class="page-item first">
      <a class="page-link" href="{{ $paginator->url(1) }}"><i class="tf-icon bx bx-chevrons-left bx-sm"></i></a>
    </li>
    <li class="page-item prev">
      <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="tf-icon bx bx-chevron-left bx-sm"></i></a>
    </li>
    @else
    <li class="page-item first" style="opacity: 0.5;">
      <a class="page-link" href="javascript:void(0);" style="cursor: not-allowed;"><i class="tf-icon bx bx-chevrons-left bx-sm"></i></a>
    </li>
    <li class="page-item prev" style="opacity: 0.5;">
      <a class="page-link" href="javascript:void(0);" style="cursor: not-allowed;"><i class="tf-icon bx bx-chevron-left bx-sm"></i></a>
    </li>
    @endif
    {{-- First Page Link --}}
    @if ($paginator->currentPage() > 3)
    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
    <span>...</span>
    @endif
    @foreach (range(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page)
    <li class="page-item{{ $page == $paginator->currentPage() ? ' active' : '' }}">
      <a class="page-link" href="{{ $page == $paginator->currentPage() ? 'javascript:void(0);' : $paginator->url($page) }}">{{ $page }}</a>
    </li>
    @endforeach
    {{-- Pages after current page --}}
    @if ($paginator->currentPage() < $paginator->lastPage() - 2)
    <span>...</span>
    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
    @endif
    @if ($paginator->hasMorePages())
    <li class="page-item next">
      <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="tf-icon bx bx-chevron-right bx-sm"></i></a>
    </li>
    <li class="page-item last">
      <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}"><i class="tf-icon bx bx-chevrons-right bx-sm"></i></a>
    </li>
    @else
    <li class="page-item next" style="opacity: 0.5;">
      <a class="page-link" href="javascript:void(0);" style="cursor: not-allowed;"><i class="tf-icon bx bx-chevron-right bx-sm"></i></a>
    </li>
    <li class="page-item last" style="opacity: 0.5;">
      <a class="page-link" href="javascript:void(0);" style="cursor: not-allowed;"><i class="tf-icon bx bx-chevrons-right bx-sm"></i></a>
    </li>
    @endif
    @php
    $lastItemInPage = $paginator->currentPage() * $paginator->perPage();
    if ($lastItemInPage > $paginator->total()) {
      $lastItemInPage = $paginator->total();
    }
    @endphp
    <div class="ms-2" style="place-self: center;">(Kết quả từ {{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }} - {{ $lastItemInPage }} trên tổng {{ $paginator->total() }})</div>
  </ul>
</nav>