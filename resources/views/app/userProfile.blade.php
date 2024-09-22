@include('app.inc.header')

<x-navbar-component/>
<div class="container pageProfile">
    <div class="userPanel">
        <span class="photo" style="background-image:url('{{ $user->photo }}')"></span>
        <h1 class="name">{{ $user->name }}
            @if($user->verify == 1)
                <i class="verify fa-solid fa-circle-check" aria-hidden="true"></i>
            @endif
            @if($user->top == 1)
                <i class="king fa-solid fa-crown" aria-hidden="true"></i>
            @endif
        </h1>
        <p class="username">{{ $user->username }}</p>
        <div class="description">{{ $user->description }}</div>
        <button type="button" id="options"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        <div id="options-menu" class="Menu">
            <a href="#"><i class="fa-solid fa-share"></i> Compartilhar</a>
            @if($subscriber == true)
            <a href="#"><i class="fa-solid fa-ban"></i> Cancelar assinatura</a>
            <a href="#"><i class="fa-solid fa-triangle-exclamation"></i> Denunciar perfil</a>
            @endif
        </div>
        <div class="social">
            @if(!empty($user->tiktok))
            <a href="{{ $user->tiktok }}" target="blank"><i class="fa-brands fa-tiktok"></i></a>
            @endif
            @if(!empty($user->instagram))
            <a href="{{ $user->instagram }}" target="blank"><i class="fa-brands fa-instagram"></i></a>
            @endif
            @if(!empty($user->facebook))
            <a href="{{ $user->facebook }}" target="blank"><i class="fa-brands fa-facebook-f"></i></a>
            @endif
            @if(!empty($user->twitter))
            <a href="{{ $user->twitter }}" target="blank"><i class="fa-brands fa-x-twitter"></i></a>
            @endif
            @if(!empty($user->telegram))
            <a href="{{ $user->telegram }}" target="blank"><i class="fa-brands fa-telegram"></i></a>
            @endif
            @if(!empty($user->site))
            <a href="{{ $user->site }}" target="blank"><i class="fa-solid fa-globe"></i></a>
            @endif
        </div>
    </div>
    <div class="stats">
        <div class="box"><span>{{ $counts['photos'] }}</span><p>Fotos</p></div>
        <div class="box"><span>{{ $counts['videos'] }}</span><p>Vídeos</p></div>
        <div class="box"><span>{{ $counts['likes'] }}</span><p>Likes</p></div>
    </div>
    <div class="UserPosts">

        @if($subscriber == false)

        <div class="sign">
            <div class="boxSign boxContent">
                <h2>Assine o conteúdo completo de {{ $user->name }}</h2>
                <p>por apenas</p>
                <span><sup>R$</sup> {{ $price }} <sub>/mensal</sub></span>
                <a href="{{ route('checkout', ['username' => str_replace('@', '', $user->username)]) }}" class="tosign"><i class="fa-solid fa-play"></i> Assinar agora</a>
            </div>
        </div>

        @else

        <div class="buttons">
            <a href="#"><i class="fa-solid fa-grip"></i> Visualizar em grade</a>
        </div>
        @foreach ($posts as $post)
            <x-post-component
                name="{{ $user->name }}"
                photo="{{ $user->photo }}"
                user="{{ $user->username }}"
                description="{{ $post->description }}"
                image="{!! $post->photos !!}"
                likes="{{ $post->likes }}"
                id="{{ $post->id }}"
                top="{{ $user->top }}"
                verify="{{ $user->verify }}"
                date="{{ $post->created_at }}"
            />
        @endforeach

        @endif
    </div>
</div>

<x-navbar-creator-component/>
@include('app.inc.footer')