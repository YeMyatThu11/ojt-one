@if ($paginator->hasPages())
    <div class="pagination">
        <ul class="pager">

            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="pgn-active">{{ $page }}</span></li>
                        @else
                            <li><a class="pagn-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

        </ul>
    </div>
    @section('style')
        <style>
            .pager {
                display: flex;
                width: 100%;
                justify-content: center;
                list-style-type: none;
                margin-top: 30px;
                position: sticky;
                bottom: 0;
            }



            .pagn-link {
                text-decoration: none;
                color: #6c757d;
                padding: 10px 20px;
            }

            .pagn-link:hover {
                color: #6c757d;
            }

            .pgn-active {
                color: #fff;
                background-color: #6c757d;
                border-radius: 10px;
                padding: 10px 20px;
            }

        </style>
    @endsection
@endif
