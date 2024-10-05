@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
<x-errors-component/>
<a href="{{ route('support') }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
<h2 class="title">Abrir um chamado</h2>
                <div class="boxContent" style="padding-top: 20px">
                    <form method="POST" action="{{ route('open-support') }}">
                        @csrf
                        <div class="input-form">
                            <label class="label" for="title">Título do chamado</label>
                            <input type="text" class="input" name="title" id="title" placeholder="Insira um título para o chamado" required></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="description">Descrição do problema/dúvida</label>
                            <textarea class="input" id="description" name="message" placeholder="Como podemos te ajudar?" required></textarea>
                        </div>
                        <div class="input-form">
                            <div class="button btn-loading">
                                <i class="fa-solid fa-plus-circle"></i>
                                <button type="submit"><span>Abrir chamado</span></button>
                            </div>
                        </div>
                    </form>
                </div>
@include('app.inc.footer')