<div class="UserLineProfile">
    <div class="img">
        <a href="#"><img src="{{ $photo }}" alt="{{ $name }}"/></a>
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
        <span class="time">Renovação em 28/10/2024</span>
        <a href="#" class="cancel"><i class="fa-solid fa-user-xmark"></i></a>
    </div>
</div>