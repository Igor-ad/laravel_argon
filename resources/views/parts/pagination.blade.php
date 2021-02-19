@if ($paginator->hasPages())

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link">
                        <i class="fa fa-angle-left"></i>
                        <span class="sr-only"></span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa fa-angle-left"></i>
                        <span class="sr-only"></span>
                    </a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <i class="fa fa-angle-right"></i>
                        <span class="sr-only"></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link">
                        <i class="fa fa-angle-right"></i>
                        <span class="sr-only"></span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
