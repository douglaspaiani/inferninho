@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
    <a href="{{ url()->previous() }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
    <h1 class="title">Mensagens</h1>
    <div class="messages">

        @foreach($notview as $new)
        <a href="{{ route('chat', ['username' => $new->username ?? $new->id]) }}" class="item new">
            @if($new->photo)
            <span class="photo" style="background-image:url('{{ env('PROFILE_IMG').$new->photo }}')"></span>
            @else
            <span class="photo" style="background-image:url('{{ URL::asset('app/images/user-default.jpg'); }}')"></span>
            @endif
            <h4>{{ $new->name }}
                @if($new->verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($new->top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </h4>
        </a>
        @endforeach

        @foreach($view as $other)
        <a href="{{ route('chat', ['username' => $other->username ?? $other->id]) }}" class="item">
            @if($other->photo)
            <span class="photo" style="background-image:url('{{ env('PROFILE_IMG').$other->photo }}')"></span>
            @else
            <span class="photo" style="background-image:url('{{ URL::asset('app/images/user-default.jpg'); }}')"></span>
            @endif
            <h4>{{ $other->name }}
                @if($other->verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($other->top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </h4>
        </a>
        @endforeach

        @if(count($view) == 0 && count($notview) == 0)
        <div class="empty">Nenhuma mensagem por aqui.</div>
        @endif
    </div>
</div>

<x-navbar-creator-component/>
@include('app.inc.footer')