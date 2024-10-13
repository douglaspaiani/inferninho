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
    <div class="beneficits" style="text-align: center">
        <p style="text-align: center">Qual valor você quer enviar<br>como mimo para <b>{{ $user->name }}</b>?</p>
        <div class="gift">
            <span>R$</span>
            <input type="text" id="valuegift" class="money" placeholder="0,00" name="value" inputmode="numeric" required>
            <p id="error-value">Valor mínimo de doação é de R$ 10,00!</p>
        </div>
        <div class="private">
            <div class="input-form input-checkbox">
                <label for="private" class="checkbox">
                    <input type="checkbox" name="private" id="private" value="1" checked>
                    <span></span>
                </label>
                <label class="label-checkbox" for="private">Enviar mimo anonimamente</label>
            </div>
        </div>
        <div class="message">
            <label for="message">Envie uma mensagem junto ao mimo:</label>
            <textarea style="margin-top:10px" class="input textarea" name="message" id="message" placeholder="Escreva sua mensagem"></textarea>
            <p id="charCount">255 caracteres restantes</p>
        </div>
        
    </div>
    <div class="subscribe">
        <h3>Selecione a forma de pagamento:</h3>
        <div class="payment">
            <button type="button" class="btn" id="btn-pix"><i class="fa-brands fa-pix"></i><span>PIX</span></button>
            <button type="button" class="btn" id="btn-card"><i class="fa-solid fa-credit-card"></i><span>Cartão de crédito</span></button>
        </div>
    </div>
    <div class="payments">
        <div class="error" id="payment-error"></div>
        <div id="method-pix">
            <div class="return-pix" style="text-align: center">
                <span class="val">Valor do pagamento:</span>
                <sup></sup>
                <center><img class="qrcode" src="" width="200"></center>
                <input type="text" class="codepix">
                <button type="button"><i class="fa-regular fa-copy"></i> Copiar código Pix</button>
            </div>
            <button type="button" id="PaymentPixGift"><i class="fa-solid fa-qrcode"></i> <span>Gerar QR Code</span></button>
        </div>
        <div id="method-card" class="form-card">
            @if(count($cards) == 0)
            <div class="empty">Você não possui nenhum cartão cadastrado.</div>
            <a href="{{ route('add-credit-card') }}?ref={{ url()->current() }}" class="btn"><i class="fa-regular fa-credit-card"></i> Cadastrar cartão de crédito</a>
            @else
            <div class="return-card" style="text-align: center">
                <span class="val">Valor do pagamento:</span>
                <sup></sup>
            </div>
            <label for="cards">Selecione um cartão de crédito para essa compra:</label>
            <select id="cards" name="card">
                @foreach($cards as $card)
                <?php $number = explode(' ', $card->number); ?>
                <option value="{{ $card->id }}">Final {{ $number[3] }} - {{ $card->brand }}</option>
                @endforeach
            </select>
            <div id="card-success">
                <i class="icon fa-regular fa-circle-check"></i>
                <h6>Pagamento aprovado!</h6>
                <a class="btn" href="{{ route('username', ['username'=>str_replace('@','',$user->username)]) }}"><i class="fa-solid fa-user"></i> Voltar ao perfil</a>
            </div>
            <button type="button" id="PaymentCardGift"><i class="fa-regular fa-circle-check"></i> <span>Finalizar pagamento</span></button>
            @endif
        </div>
    </div>
</div>
</div>
<input type="hidden" name="username" value="{{ str_replace('@','',$user->username) }}">
<input type="hidden" name="photo" value="{{ $post->id }}">
@include('app.inc.footer')