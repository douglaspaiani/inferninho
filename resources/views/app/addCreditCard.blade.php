@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
<a href="{{ route('credit-cards') }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>

                <h2 class="title">Cadastrar novo cartão de crédito</h2>

                <x-errors-component/>

                <div class="AddCard boxContent">
                    <form class="section" method="POST" action="{{ route('add-credit-card') }}">
                        @csrf
                        <div class="input-form">
                            <label class="label" for="number">Número do cartão de crédito</label>
                            <input type="text" class="input card" name="number" id="number" placeholder="**** **** **** ****" inputmode="numeric" required></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="name">Nome no cartão</label>
                            <input type="text" class="input" name="name" style="text-transform: uppercase" id="name" placeholder="Nome conforme está no cartão" required></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="valid">Validade</label>
                            <input type="text" class="input valid" name="valid" id="valid" placeholder="00/00" inputmode="numeric" required></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="code">Código de segurança</label>
                            <input type="text" class="input code" name="code" id="code" placeholder="000" inputmode="numeric" required></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="cpf">CPF do proprietário do cartão</label>
                            <input type="text" class="input cpf" name="cpf" id="cpf" placeholder="000.000.000-00" inputmode="numeric" required></input>
                        </div>
                        <div class="input-form">
                            <div class="button btn-loading">
                                <i class="fa-solid fa-circle-plus"></i>
                                <button type="submit"><span>Cadastrar cartão</span></button>
                            </div>
                        </div>
                    </form>
                </div>
@include('app.inc.footer')