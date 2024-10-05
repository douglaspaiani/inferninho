@include('app.inc.header')

<x-navbar-component/>

<div class="container page supportPage">

    <a href="{{ url()->previous() }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>

    <h2 class="title">Chamados de suporte</h2>

    <x-errors-component/>

    @if(count($open) > 0)
    <h4>Chamados em aberto</h4>
    @foreach($open as $support)
    <a href="{{ route('read-support', ['id' => $support->id]) }}" class="item-support @if($support->view_user == 0) open @endif">
        <span>{{ $support->title }}</span>
        @if($support->view_user == 0)
        <i class="fa-solid fa-bell pulse"></i>
        @else
        <i class="fa-regular fa-clock"></i>
        @endif
    </a>
    @endforeach
    @endif

    @if(count($closed) > 0)
    <h4 style="margin-top: 30px">Chamados em encerrados</h4>
    @foreach($closed as $support)
    <a href="{{ route('read-support', ['id' => $support->id]) }}" class="item-support">
        <span>{{ $support->title }}</span>
        <i class="fa-solid fa-circle-check"></i>
    </a>
    @endforeach
    @endif

    @if(count($closed) == 0 && count($open) == 0)
        <div class="empty">Você não possui chamado de suporte aberto.</div>
    @endif

    @if(count($open) < 3)
    <a href="{{ route('open-support') }}" class="addCard"><i class="fa-solid fa-plus"></i> Abrir novo chamado</a>
    @else
    <div class="empty">Após resolver esses chamados você poderá abrir novos.</div>
    @endif
</div>

@include('app.inc.footer')