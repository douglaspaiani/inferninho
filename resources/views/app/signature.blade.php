@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
<x-errors-component/>
<a href="{{ route('home') }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
<a href="{{ $user['link'] }}" class="right"><i class="fa-solid fa-user" style="margin-right:8px"></i> Ver meu perfil</a>
                <h2 class="title" style="margin-top: 50px">Planos de assinatura</h2>
                <div class="tabs">
                    <a href="{{ route('profile') }}">Editar perfil</a>
                    <a href="#" class="active">Planos de assinatura</a>
                </div>
                <div class="AddCard boxContent forTabs">
                    <form method="POST" action="{{ route('signature') }}">
                        @csrf
                        <h2 class="title" style="margin-top: 50px">Gerencie o preço das assinaturas<br>do seu conteúdo</h2>
                        <div class="input-form">
                            <label class="label" for="1m">Assinatura de 1 mês</label>
                            <div class="input-mock mock-icon">
                                <span class="mock icon">R$</span><input type="text" class="input money" id="1m" name="price_1" mode placeholder="0,00" value="{{ $user['price_1'] }}" inputmode="numeric" required></input>
                            </div>
                        </div>
                        <div class="input-form">
                            <label class="label" for="3m">Assinatura de 3 meses</label>
                            <div class="input-mock mock-icon">
                                <span class="mock icon">R$</span><input type="text" class="input money" id="3m" name="price_3" placeholder="0,00" value="{{ $user['price_3'] }}" inputmode="numeric" required></input>
                            </div>
                        </div>
                        <div class="input-form">
                            <label class="label" for="6m">Assinatura de 6 meses</label>
                            <div class="input-mock mock-icon">
                                <span class="mock icon">R$</span><input type="text" class="input money" id="6m" name="price_6" placeholder="0,00" value="{{ $user['price_6'] }}" inputmode="numeric" required></input>
                            </div>
                        </div>
                        <div class="input-form">
                            <div class="button btn-loading">
                                <i class="fa-solid fa-save"></i>
                                <button type="submit"><span>Salvar alterações</span></button>
                            </div>
                        </div>
                    </form>
                </div>
@include('app.inc.footer')