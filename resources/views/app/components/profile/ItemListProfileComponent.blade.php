<div class="UserLineProfile">
    <div class="img">
        <a href="{{ route('username', ['username' => $user]) }}"><span class="img-profile" style="background-image:url('{{ $photo }}" alt="{{ $name }}')"></span></a>
    </div>
    <div class="user">
        <a href="{{ route('username', ['username' => $user]) }}"><span>{{ $name }}
            @if($verify == 1)
            <i class="verify fa-solid fa-circle-check"></i>
            @endif
            @if($top == 1)
            <i class="king fa-solid fa-crown"></i>
            @endif
        </span></a>
        <a href="{{ route('username', ['username' => $user]) }}"><i>{{ '@'.$user }}</i></a>
        @if($renew == 1)
        <span class="time">Renovação automática em {{ $dueDate }}</span>
        @else
            @if($status == 1)
                <span class="time">Encerra em {{ $dueDate }}</span>
            @else
                <span class="time">Encerrado em {{ $dueDate }}</span>
            @endif
        @endif
        <!--<a href="#" class="cancel"><i class="fa-solid fa-user-xmark"></i></a>-->
    </div>
</div>