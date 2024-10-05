@include('app.inc.header')

<x-navbar-component/>

<div class="container page supportPage">

    <a href="{{ url()->previous() }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>

    <h2 class="title">{{ $support->title }}</h2>

    <div class="messages-support">
        @foreach($messages as $msg)
        <div class="item">
            @if($msg->user == 1)
            <?php $n = 1; ?>
            <div class="UserLineProfile">
                <div class="img">
                    <span class="img-profile" style="background-image:url('{{ $photo }}" alt="{{ $name }}')"></span>
                </div>
                <div class="user">
                    <span>{{ $name }}</span>
                    <span class="time">Enviado em {{ \Carbon\Carbon::parse($msg->created_at)->format('d/m/Y - H:i') }}</span>
                </div>
            </div>
            @else
            <?php $n = 0; ?>
            <div class="UserLineProfile">
                <div class="img">
                    <span class="img-profile" style="background-image:url('{{ URL::asset('app/images/user-default.jpg') }}"></span>
                </div>
                <div class="user">
                    <span>Suporte do {{ env('APP_NAME') }}</span>
                    <span class="time">Enviado em {{ \Carbon\Carbon::parse($msg->created_at)->format('d/m/Y - H:i') }}</span>
                </div>
            </div>
            @endif
            <div class="message">
                {{ $msg->message }}
            </div>
        </div>
        @endforeach
    </div>
@if($n == 0)
    <div class="boxContent" style="padding-top: 20px">
        <form method="POST" action="{{ route('read-support', ['id' => $support->id]) }}">
            @csrf
            <div class="input-form">
                <textarea class="input" id="description" name="message" placeholder="Escreva uma resposta aqui..." required></textarea>
            </div>
            <div class="input-form">
                <div class="button btn-loading">
                    <i class="fa-solid fa-reply"></i>
                    <button type="submit"><span>Enviar resposta</span></button>
                </div>
            </div>
        </form>
    </div>
@else
<div class="empty">
    Aguarde a resposta do nosso suporte.
</div>
@endif
</div>

<div id="RemoveSupport" class="notification">
    <h4>Deseja mesmo encerrar esse chamado de suporte?</h4>
    <button type="button" data-id="0" class="confirm">Sim, encerrar</button>
    <button type="button" class="cancel">Cancelar</button>
</div>

@include('app.inc.footer')