@include('app.inc.header')
<div>
    <span class="backgroundLogin">
        <p>Monetize sua liberdade,<br/>seja dono do seu inferninho!</p>
    </span>
    <div class="boxLogin pageLogin">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Acesse sua conta</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="error">
                    {{ $error }}
                </div>
                @endforeach
            @endif
            <div class="input">
                <label for="email">Endereço de e-mail</label>
                <input type="email" id="email" name="email" placeholder="Insira seu e-mail" required autofocus/>
                <i class="fa-regular fa-envelope"></i>
            </div>
            <div class="input">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Insira sua senha" required/>
                <i class="fa-solid fa-lock"></i>
                <a href="#" class="passwordRecovery">Esqueceu sua senha?</a>
            </div>
            <div class="button btn-loading">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                <button type="submit"><span>Entrar</span></button>
            </div>
            <div class="buttonsSocial">
                <button class="google" type="button"><span class="iconGoogle"></span> Entrar com o Google</button>
                <button class="google" type="button"><span class="iconTwitter"></span> Entrar com o Twitter</button>
            </div>
            <a href="{{ route('register') }}" class="signin">Inscreva-se no Inferninho</a>
        </form>
    </div>
</div>
@include('app.inc.footer')