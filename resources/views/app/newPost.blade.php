@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
    <div class="Post noAfter">

    <x-errors-component/>

    <div class="UserLine">
        <div class="img">
            <a href="#"><span class="img-profile" style="background-image:url('{{ $user->photo }}')"></span></a>
        </div>
        <div class="user">
            <a href="#"><span>{{ $user->name }}
                @if($user->verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($user->top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </span></a>
            
            <a href="#"><i>{{ $user->username }}</i></a>
        </div>
    </div>
    <form class="newPost" method="POST" action="{{ route('newPost') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="nocomments" value="0">
        <input type="hidden" name="24h" value="0">
        <textarea class="description-post" name="description" placeholder="Escreva uma descrição para essa publicação..." autofocus></textarea>
        <input type="file" name="photos[]" id="photos" style="display: none" multiple accept="image/*">
        <div id="imagePreview"></div>
        <div class="opcional-posting">
            <button type="button" id="schedule-button"><i class="fa-regular fa-calendar-days"></i> <span>Agendar</span></button>
            <button type="button" id="monetize-button"><i class="fa-solid fa-dollar-sign"></i> <span>Monetizar</span></button>
            <button type="button" id="nocomments-button"><i class="fa-solid fa-comment-slash"></i> <span>Desativar comentários</span></button>
            <button type="button" id="announce-button"><i class="fa-solid fa-bullhorn"></i> <span>Anunciar</span></button>
            <button type="button" id="24h-button"><i class="fa-solid fa-stopwatch"></i> <span>24h</span></button>
        </div>
        <div class="tabs">
            <div id="tab-schedule" style="display: none">
                <label for="schedule">Agende sua postagem</label>
                <input type="datetime-local" class="input" inputmode="numeric" name="schedule" id="schedule">
            </div>  
            <div id="tab-monetize" style="display: none">
                <div class="input-form">
                    <label class="label" for="1m">Valor de venda (Recomendado: R$3 - R$30)*</label>
                    <div class="input-mock mock-icon">
                        <span class="mock icon">R$</span><input type="text" class="input money" id="1m" name="value" placeholder="0,00" inputmode="numeric"></input>
                    </div>
                </div>
                <label style="text-align: center;margin-bottom:20px">*Foto visível apenas para assinantes que comprarem separadamente.</label>
            </div>
            <div id="tab-announce" style="display: none">
                <label for="announce">Anuncie para todos na timeline principal</label>
                <div class="cycle">
                    <div class="plan">
                        <input type="radio" name="announce" value="7" id="price_1">
                        <label for="price_1"><span>7 dias por <b>R$ {{ number_format(env('PULSE_7DAYS'), 2, ',', '.') }}</b></span></label>
                    </div>
                    <div class="plan">
                        <input type="radio" name="announce" value="14" id="price_2">
                        <label for="price_2"><span>14 dias por <b>R$ {{ number_format(env('PULSE_14DAYS'), 2, ',', '.') }}</b></span></label>
                    </div>
                    <div class="plan">
                        <input type="radio" name="announce" value="30" id="price_3">
                        <label for="price_3"><span>30 dias por <b>R$ {{ number_format(env('PULSE_30DAYS'), 2, ',', '.') }}</b></span></label>
                    </div>
                </div>
                <label style="text-align: center">Consumido do seu limite disponível em carteira</label>
            </div>   
        </div>
        <div class="buttons">
            <button type="button" id="btn-add-photo"><i class="fa-solid fa-camera"></i><span>Selecionar até 5 fotos</span></button>
            <button type="button"><i class="fa-solid fa-video"></i><span>Selecione 1 vídeo</span></button>
        </div>
        <button type="submit" class="button send"><i class="fa-solid fa-paper-plane"></i> <span>Postar conteúdo</span></button>
    </form>
</div>
</div>
<script>
    $(document).ready(function(){
        $('.description-post').select();
    });
</script>
@include('app.inc.footer')