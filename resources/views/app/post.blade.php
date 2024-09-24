@include('app.inc.header')
<x-navbar-component/>

<div class="container page">
<a href="{{ url()->previous() }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
<x-errors-component/>

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
        date="{{ $post->schedule }}"
        nocomments="{{ $post->nocomments }}"
        value="{{ $post->value }}"
    />

</div>

<x-navbar-creator-component/>
@include('app.inc.footer')