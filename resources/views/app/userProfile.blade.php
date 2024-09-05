@include('app.inc.header')

<x-navbar-component/>
<div class="container pageProfile">
    <div class="userPanel">
        <span class="photo" style="background-image:url('{{ $user->photo }}')"></span>
        <h1 class="name">{{ $user->name }}</h1>
        <p class="username">{{ $user->username }}</p>
        <div class="description">{{ $user->description }}</div>
        <div class="social">
            <a href="#" target="blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" target="blank"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" target="blank"><i class="fa-brands fa-x-twitter"></i></a>
        </div>
        <div class="stats">
            <div class="box"><span>{{ $counts['photos'] }}</span><p>Fotos</p></div>
            <div class="box"><span>{{ $counts['videos'] }}</span><p>Vídeos</p></div>
            <div class="box"><span>{{ $counts['likes'] }}</span><p>Likes</p></div>
        </div>
    </div>
    <div class="UserPosts">
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
    </div>
</div>

@include('app.inc.footer')