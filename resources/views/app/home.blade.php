@include('app.inc.header')
<x-navbar-component/>
<div class="container page">

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
    />
@endforeach
</div>

<x-navbar-creator-component/>
@include('app.inc.footer')