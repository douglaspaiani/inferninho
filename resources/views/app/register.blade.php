@include('app.inc.header')
<div>
    <span class="backgroundLogin">
        <p>Monetize sua liberdade,<br/>seja dono do seu inferninho!</p>
    </span>
    <div class="boxLogin pageRegister">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Crie sua conta grátis!</h1>
            <div class="buttonsSocial" style="margin-bottom: 40px">
                <button class="google" type="button"><span class="iconGoogle"></span> Registrar com o Google</button>
                <button class="google" type="button"><span class="iconTwitter"></span> Registrar com o Twitter</button>
            </div>
            <span class="or">Ou</span>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="error">
                    {{ $error }}
                </div>
                @endforeach
            @endif
            <div class="input">
                <label for="name">Nome completo</label>
                <input type="text" id="name" name="name" placeholder="Insira seu nome e sobrenome" required/>
                <i class="fa-regular fa-user"></i>
            </div>
            <div class="input">
                <label for="birth">Data de nascimento</label>
                <input type="text" class="date" id="birth" name="birth" placeholder="00/00/0000" required/>
                <i class="fa-regular fa-calendar-days"></i>
            </div>
            <div class="input">
                <label for="email">Endereço de e-mail</label>
                <input type="email" id="email" name="email" placeholder="Insira seu e-mail" required/>
                <i class="fa-regular fa-envelope"></i>
            </div>
            <div class="input">
                <label for="password">Crie uma senha</label>
                <input type="password" id="password" name="password" placeholder="Crie uma senha forte" required/>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="input">
                <label for="new-password">Confirme sua senha</label>
                <input type="password" id="new-password" name="new-password" placeholder="Confirme sua senha" required/>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="button btn-loading">
                <i class="fa-regular fa-circle-check"></i>
                <button type="submit"><span>Criar conta</span></button>
            </div>
            <a href="{{ route('login') }}" class="signin">Já tenho uma conta</a>
        </form>
    </div>
</div>
@include('app.inc.footer')