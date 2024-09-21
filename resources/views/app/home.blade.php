@include('app.inc.header')
<x-navbar-component/>
<div class="container page">
<x-errors-component/>
@foreach ($posts as $post)
    <x-post-component
        name="{{ $post->name }}"
        photo="{{ $post->photo }}"
        user="{{ $post->username }}"
        description="{{ $post->description }}"
        image="{!! $post->photos !!}"
        likes="{{ $post->likes }}"
        id="{{ $post->id }}"
        top="{{ $post->top }}"
        verify="{{ $post->verify }}"
        date="{{ $post->created_at }}"
    />
@endforeach
@if(count($posts) == 0)
<div class="empty">Nenhum conteúdo para você no momento.</div>
@endif
</div>

<x-navbar-creator-component/>
@include('app.inc.footer')