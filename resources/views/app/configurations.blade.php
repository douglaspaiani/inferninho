@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
<a href="{{ route('home') }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
                <h2 class="title">Configurações da conta</h2>
                <x-errors-component/>
                <form class="boxContent" method="POST" action="{{ route('configurations') }}">
                    @csrf
                    <div class="section">
                        <h3 class="subtitle">Opções de privacidade</h3>
                        <div class="input-form input-checkbox">
                            <label for="hidden_name" class="checkbox">
                                <input type="checkbox" name="hidden_name" id="hidden_name" value="1" @if($user->hidden_name == 1) checked @endif>
                                <span></span>
                            </label>
                            <label class="label-checkbox" for="hidden_name">Ocultar meu nome nos comentários</label>
                        </div>
                    </div>
                    <div class="section">
                        <h3 class="subtitle">Dados de cobrança</h3>
                        <p class="sub">Usado para compras nos cartões de créditos cadastrados.</p>
                        <div class="AddCard" style="margin-top: 30px">
                                <div class="input-form">
                                    <label class="label" for="zipcode">CEP</label>
                                    <input type="text" class="input zipcode" name="zipcode" id="zipcode" placeholder="00000-000" inputmode="numeric" value="{{ $user->zipcode }}" required></input>
                                </div>
                                <div class="input-form">
                                    <label class="label" for="address">Endereço</label>
                                    <input type="text" class="input" name="address" id="address" placeholder="Nome da rua" value="{{ $user->address }}" required></input>
                                </div>
                                <div class="input-form">
                                    <label class="label" for="number">Número</label>
                                    <input type="number" class="input" name="number" id="number" placeholder="Número da residência" min="1" value="{{ $user->number }}" required></input>
                                </div>
                                <div class="input-form">
                                    <label class="label" for="complement">Complemento</label>
                                    <input type="text" class="input" name="complement" id="complement" placeholder="Complemento (ex.: casa, apartamento)" value="{{ $user->complement }}"></input>
                                </div>
                                <div class="input-form">
                                    <label class="label" for="neighborhood">Bairro</label>
                                    <input type="text" class="input" name="neighborhood" id="neighborhood" placeholder="Bairro" value="{{ $user->neighborhood }}" required></input>
                                </div>
                                <div class="input-form">
                                    <label class="label" for="city">Cidade</label>
                                    <input type="text" class="input" name="city" id="city" placeholder="Cidade" value="{{ $user->city }}" required></input>
                                </div>
                                <div class="input-form">
                                    <label class="label" for="state">Estado</label>
                                    <select class="input" id="state" name="state" required>
                                        <option value="">Selecione</option>
                                        <option value="AC" @if($user->state == 'AC') selected @endif>Acre</option>
                                        <option value="AL" @if($user->state == 'AL') selected @endif>Alagoas</option>
                                        <option value="AP" @if($user->state == 'AP') selected @endif>Amapá</option>
                                        <option value="AM" @if($user->state == 'AM') selected @endif>Amazonas</option>
                                        <option value="BA" @if($user->state == 'BA') selected @endif>Bahia</option>
                                        <option value="CE" @if($user->state == 'CE') selected @endif>Ceará</option>
                                        <option value="DF" @if($user->state == 'DF') selected @endif>Distrito Federal</option>
                                        <option value="ES" @if($user->state == 'ES') selected @endif>Espírito Santo</option>
                                        <option value="GO" @if($user->state == 'GO') selected @endif>Goiás</option>
                                        <option value="MA" @if($user->state == 'MA') selected @endif>Maranhão</option>
                                        <option value="MT" @if($user->state == 'MT') selected @endif>Mato Grosso</option>
                                        <option value="MS" @if($user->state == 'MS') selected @endif>Mato Grosso do Sul</option>
                                        <option value="MG" @if($user->state == 'MG') selected @endif>Minas Gerais</option>
                                        <option value="PA" @if($user->state == 'PA') selected @endif>Pará</option>
                                        <option value="PB" @if($user->state == 'PB') selected @endif>Paraíba</option>
                                        <option value="PR" @if($user->state == 'PR') selected @endif>Paraná</option>
                                        <option value="PE" @if($user->state == 'PE') selected @endif>Pernambuco</option>
                                        <option value="PI" @if($user->state == 'PI') selected @endif>Piauí</option>
                                        <option value="RJ" @if($user->state == 'RJ') selected @endif>Rio de Janeiro</option>
                                        <option value="RN" @if($user->state == 'RN') selected @endif>Rio Grande do Norte</option>
                                        <option value="RS" @if($user->state == 'RS') selected @endif>Rio Grande do Sul</option>
                                        <option value="RO" @if($user->state == 'RO') selected @endif>Rondônia</option>
                                        <option value="RR" @if($user->state == 'RR') selected @endif>Roraima</option>
                                        <option value="SC" @if($user->state == 'SC') selected @endif>Santa Catarina</option>
                                        <option value="SP" @if($user->state == 'SP') selected @endif>São Paulo</option>
                                        <option value="SE" @if($user->state == 'SE') selected @endif>Sergipe</option>
                                        <option value="TO" @if($user->state == 'TO') selected @endif>Tocantins</option>
                                        <option value="EX" @if($user->state == 'EX') selected @endif>Estrangeiro</option>
                                    </select>
                                </div>
                                <div class="input-form">
                                    <div class="button btn-loading">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        <button type="submit"><span>Salvar alterações</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
@include('app.inc.footer')