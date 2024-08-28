@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
    <div class="Cards">
        <div class="Card">
            <p class="number">**** **** **** 6454</p>
            <p class="validate">02/31</p>
            <a href="/" class="RemoveCard"><i class="fa-regular fa-trash-can"></i> Remover</a>
        </div>
    </div>
    <a href="{{ route('add-credit-card') }}" class="addCard"><i class="fa-solid fa-plus"></i> Adicionar novo cartão</a>
</div>

@include('app.inc.footer')