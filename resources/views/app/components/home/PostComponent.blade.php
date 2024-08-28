<div class="Post" id={{ $id }}>
    <div class="UserLine">
        <div class="img">
            <a href={url}><img src="{{ $photo }}" alt="{{ $name }}"/></a>
        </div>
        <div class="user">
            <a href={url}><span>{{ $name }}
                @if($verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </span></a>
            
            <a href="#"><i>{{ $user }}</i></a>
        </div>
    </div>
    <div class="posting">
        <div class="description">
            {{ $description }}
        </div>
        <div class="imgPost">
            @if(!empty($image))
            <span class="image" style="background-image: url('{{ $image }}')"></span>
            @endif
            <span class="likePhoto"><i class="fa-solid fa-heart"></i></span>
        </div>
        <div class="infos">
            <button type="button" onClick={LikePost(id)} data-id={id} class="like button-like"><i class="fa-regular fa-heart"></i> <span>{{ $likes }}</span></button>
            <A href="#" class="button-like"><i class="fa-solid fa-dollar-sign"></i> <span>Enviar um mimo</span></Link>
        </div>
    </div>
</div>