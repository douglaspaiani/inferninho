@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
<a href="{{ url()->previous() }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
<h1 class="title">Fotos compradas</h1>
<div class="Post noAfter solds">
<h6>Sua biblioteca</h6>
@if(count($posts) == 0)
<div class="empty">Sua biblioteca está vazia.</div>
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
            private="0"
        />
        @endforeach
    </div>
</div>
</div>
<x-navbar-creator-component/>
@include('app.inc.footer')