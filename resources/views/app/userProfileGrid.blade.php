@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
<a href="{{ url()->previous() }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
<div class="Post noAfter">
<div class="UserLine">
    <div class="img">
        <a href="#"><span class="img-profile" style="background-image:url('{{ $user->photo }}')"></span></a>
    </div>
    <div class="user">
        <a href="#"><span>{{ $user->name }}
            @if($user->verify == 1)
            <i class="verify fa-solid fa-circle-check"></i>
            @endif
            @if($user->top == 1)
            <i class="king fa-solid fa-crown"></i>
            @endif
        </span></a>
        
        <a href="#"><i>{{ $user->username }}</i></a>
    </div>
</div>
@if(count($posts) == 0)
<div class="empty">Sem conteúdos por enquanto.</div>
@endif
        @foreach ($posts as $index => $post)
        @if ($index % 3 === 0)
            @if ($index !== 0)
            </div>
            @endif
        <div class="grid">
        @endif
        <x-post-grid-component
            image="{!! $post->photos !!}"
            id="{{ $post->id }}"
            private="{{ $post->private }}"
        />
        @endforeach
    </div>
</div>
</div>
<x-navbar-creator-component/>
@include('app.inc.footer')