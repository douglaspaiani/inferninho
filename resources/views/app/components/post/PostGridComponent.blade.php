@if($private == 1 && $sold == 0)
<a href="{{ route('post', ['id' => $id]) }}" class="item" style="background-color:#272727"><i class="fa-regular fa-eye-slash"></i></a>
@else
<a href="{{ route('post', ['id' => $id]) }}" class="item" style="background-image:url({{ $image_post }})"></a>
@endif