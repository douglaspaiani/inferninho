@include('app.inc.header')
<x-navbar-component/>
<div class="container page">
<x-post-component
    name="Laísa Cristina"
    photo="laisa.jpg"
    user="@laisacristina"
    description="Teste de descrição"
    image="laisa.jpg"
    likes="15"
    id="16"
    top="1"
    verify="1"
/>

<x-post-component
    name="Laísa Cristina"
    photo="laisa.jpg"
    user="@laisacristina"
    description="Teste de descrição"
    image="laisa.jpg"
    likes="15"
    id="16"
    top="1"
    verify="1"
/>

</div>
<x-navbar-creator-component/>
@include('app.inc.footer')