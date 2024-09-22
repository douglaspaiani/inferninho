@include('app.inc.header')

<x-navbar-component/>

<div class="container page">

    <a href="{{ route('home') }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>

    <h2 class="title">Meus cartões</h2>

    @foreach($cards as $card)
    <x-credit-card-component
        id="{{ $card['id'] }}"
        number="{{ $card['number'] }}"
        brand="{{ $card['brand'] }}"
        valid="{{ $card['valid'] }}"
    />
    @endforeach

    <a href="{{ route('add-credit-card') }}" class="addCard"><i class="fa-solid fa-plus"></i> Adicionar novo cartão</a>

</div>

<div id="RemoveCard" class="notification">
    <h4>Deseja mesmo remover esse cartão de crédito da sua carteira?</h4>
    <button type="button" data-id="0" class="confirm">Sim, remover</button>
    <button type="button" class="cancel">Cancelar</button>
</div>

@include('app.inc.footer')