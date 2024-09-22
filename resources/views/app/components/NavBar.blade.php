<div class="Header">
    <span class="overlay" onClick="closeMenu();"></span>
    <a href="{{ route('home') }}"><img class="logo" src="{{ URL::asset('app/images/logo.png') }}"/></a>
    <a href="#" id="Search" class="Search"><i class="fa-solid fa-magnifying-glass"></i></a>
    <a href="#" class="Messages"><i class="fa-regular fa-comment"></i><span>6</span></a>
    <button class="mainMenu" onClick="openMenu();" type="button">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="Menu">
        <a href="{{ route('following') }}"><i class="fa-regular fa-user"></i> Minhas assinaturas</a>
        <a href="{{ route('credit-cards') }}"><i class="fa-regular fa-credit-card"></i> Meus cartões</a>
        <a href="#"><i class="fa-regular fa-circle-play"></i> Seja Criador</a>
        <hr color="#4b4b4b"/>
        <a href="{{ route('configurations') }}"><i class="fa-solid fa-gear"></i> Configurações</a>
        <a href="#"><i class="fa-solid fa-shield-halved"></i> Segurança e privacidade</a>
        <a href="#"><i class="fa-solid fa-circle-question"></i> Ajuda</a>
        <hr color="#4b4b4b"/>
        <a href="{{ route('logout') }}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sair da conta</a>
    </div>
</div>
<div id="SearchBar">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Procure por um criador...">
</div>
<div id="ResultsSearch">
    
</div>