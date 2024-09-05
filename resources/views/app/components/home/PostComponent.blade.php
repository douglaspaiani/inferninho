<div class="Post" id="app">
    <div class="UserLine">
        <div class="img">
            <a href="#"><span class="img-profile" style="background-image:url('{{ $photo }}" alt="{{ $name }}')"></span></a>
        </div>
        <div class="user">
            <a href="#"><span>{{ $name }}
                @if($verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </span></a>
            
            <a href="#"><i>{{ $user }}</i></a>
            <p class="date-posting">Postado {{ $date }}</p>
        </div>
    </div>
    <div class="posting">
        <div class="description">
            {{ $description }}
        </div>
        <div class="imgPost">
            @if(!empty($image))
                @foreach ($images as $photo)
                    <span class="image" style="background-image: url('{{ $photo_url }}{{ $photo }}')"></span>
                @endforeach
            @endif
        </div>
        <div class="infos">
            <button id="like-{{ $id }}" type="button" class="like button-like" onclick="likePost({{ $id }}, {{ $likes }});">
                <i class="fa-regular fa-heart"></i> <span>{{ $likes }}</span>
            </button>
            <a href="#" class="button-like"><i class="fa-solid fa-dollar-sign"></i> <span>Enviar um mimo</span></a>
        </div>
    </div>
</div>
