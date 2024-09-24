@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
    <a href="{{ route('home') }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
    <h1 class="title">Suas assinaturas</h1>
    <div class="boxContent">
@foreach($users as $user)
    <x-item-list-profile-component
        name="{{ $user->name }}"
        photo="{{ $user->photo }}"
        user="{{ $user->username }}"
        dueDate="{{ $user->due_date }}"
        id="{{ $user->id }}"
        verify="{{ $user->verify }}"
        top="{{ $user->top }}"
        renew="{{ $user->renew }}"
        status="{{ $user->status }}"
    />
@endforeach

@if(count($users) == 0)
<div class="empty">Você não possui nenhuma assinatura ativa.</div>
@endif

@if(count($expired) > 0)
<h3 class="subtitle">Expirados</h3>
@foreach($expired as $user)
    <x-item-list-profile-component
        name="{{ $user->name }}"
        photo="{{ $user->photo }}"
        user="{{ $user->username }}"
        dueDate="{{ $user->due_date }}"
        id="{{ $user->id }}"
        verify="{{ $user->verify }}"
        top="{{ $user->top }}"
        renew="{{ $user->renew }}"
        status="{{ $user->status }}"
    />
@endforeach
@endif
</div>
</div>

<x-navbar-creator-component/>

@include('app.inc.footer')