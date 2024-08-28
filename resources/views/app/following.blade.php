@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
    <h1 class="title">Seguindo / Assinaturas</h1>
    <x-item-list-profile-component
        name="Laísa Cristina"
        photo="laisa.jpg"
        user="@laisacristina"
        id="16"
        verify="1"
        top="1"
    />
</div>

<x-navbar-creator-component/>

@include('app.inc.footer')