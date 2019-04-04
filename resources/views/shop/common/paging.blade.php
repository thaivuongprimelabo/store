@if ($paginator->hasPages())
    <div class="shop-pag text-center">
    	<nav>
          <ul class="pagination clearfix">
            	<li class="page-item text hidden-xs disabled"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
            	@foreach ($elements as $element)
            	@if (is_string($element))
                    <li class="active page-item disabled"><span>{{ $element }}</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                	@foreach ($element as $page => $url)
                		 @if ($page == $paginator->currentPage())
                		 	<li class="active page-item disabled"><a class="page-link" href="javascript:void(0)">{{ $page }}</a></li>
                		 @else
                		 	<li class="page-item"><a class="page-link" onclick="doSearch(2)" href="javascript:void(0)">2</a></li>
                		 @endif
                	@endforeach
                @endif
        		
        		@endforeach
            	<li class="page-item hidden-xs text"><a class="page-link" onclick="doSearch(2)" href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
          </ul>
    	</nav>
    </div>
@endif