@if(isset($url1))
<td align="center"><a href="javascript:void(0)" data-url="{{ $url1 }}" class="remove-row" title="Remove"><i class="fa fa-trash" aria-hidden="true" style="font-size: 24px"></i></a></td>
@endif
@if(isset($url2))
<td align="center"><a href="javascript:void(0)" data-url="{{ $url2 }}" class="edit" title="Edit"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 24px"></i></a></td>
@endif