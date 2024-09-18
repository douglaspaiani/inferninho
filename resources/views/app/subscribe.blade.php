@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
    <div class="Post noAfter">
        
    <x-errors-component/>

    <div class="UserLine">
        <div class="img">
            <a href="{{ route('username', ['username'=>str_replace('@','',$user->username)]) }}"><span class="img-profile" style="background-image:url('{{ $user->photo }}')"></span></a>
        </div>
        <div class="user">
            <a href="{{ route('username', ['username'=>str_replace('@','',$user->username)]) }}"><span>{{ $user->name }}
                @if($user->verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($user->top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </span></a>
            
            <a href="{{ route('username', ['username'=>str_replace('@','',$user->username)]) }}"><i>{{ $user->username }}</i></a>
        </div>
    </div>
    <div class="beneficits">
        <p>Assine e tenha acesso exclusivo aos benefícios:</p>
        <ul>
            <li><i class="fa-solid fa-circle-check"></i> Acesso livre ao conteúdo</li>
            <li><i class="fa-solid fa-circle-check"></i> Chat exclusivo com {{ $user->name }}</li>
            <li><i class="fa-solid fa-circle-check"></i> Cancele a qualquer momento</li>
        </ul>
    </div>
    <div class="cycle">
        <h3>Selecione um pacote:</h3>
        <div class="plan">
            <input type="radio" name="plan" value="{{ $user->price_1 }}" id="price_1" checked>
            <label for="price_1"><span>1 mês por <b>R$ {{ number_format($user->price_1, 2, ',', '.') }}</b></span></label>
        </div>
        <div class="plan">
            <input type="radio" name="plan" value="{{ $user->price_3 }}" id="price_3">
            <label for="price_3"><span>3 meses por <b>R$ {{ number_format($user->price_3, 2, ',', '.') }}</b></span></label>
        </div>
        <div class="plan">
            <input type="radio" name="plan" value="{{ $user->price_6 }}" id="price_6">
            <label for="price_6"><span>6 meses por <b>R$ {{ number_format($user->price_6, 2, ',', '.') }}</b></span></label>
        </div>
    </div>
    <div class="subscribe">
        <h3>Selecione a forma de pagamento:</h3>
        <div class="payment">
            <button type="button"><i class="fa-brands fa-pix"></i><span>PIX</span></button>
            <button type="button"><i class="fa-solid fa-credit-card"></i><span>Cartão de crédito</span></button>
        </div>
    </div>
</div>
</div>

@include('app.inc.footer')