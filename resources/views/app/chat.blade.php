@include('app.inc.header')

<x-navbar-component/>

<div class="container page chatpage">
<a href="{{ url()->previous() }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
<div class="Post chat noAfter">
    <div class="UserLine">
        <div class="img">
            @if(str_replace('@', '', $user->username))
            <a href="{{ route('username', ['username' => str_replace('@', '', $user->username)]) }}"><span class="img-profile" style="background-image:url('{{ $user->photo }}')"></span></a>
            @else
            <a href="#"><span class="img-profile" style="background-image:url('{{ URL::asset('app/images/user-default.jpg'); }}')"></span></a>
            @endif
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
            @if(str_replace('@', '', $user->username))
            <a href="#"><i>{{ $user->username }}</i></a>
            @endif
        </div>
    </div>
</div>

    <div id="chat-box">
        @foreach($messages as $msg)
        <div class="line @if($msg->sender == Auth::id()) my-line @endif">
            <div class="message @if($msg->sender == Auth::id()) me @endif"><p>{{ $msg->message }}</p></div>
        </div>
        @endforeach
    </div>
    
    <form id="chat-form">
        @csrf
        <div class="message-box">
            <input type="text" id="message-input" placeholder="Escreva sua mensagem...">
            <button class="snd" type="submit"><i class="fa-regular fa-paper-plane"></i></button>
        </div>
    </form>

</div>
<script>
    $(document).ready(function(){
        setInterval(function() {
    $.ajax({
        url: 'your-url-here',  // Substitua pela URL da sua requisição
        method: 'GET',          // Ou 'POST', dependendo do tipo de requisição
        success: function(response) {
            console.log('Requisição AJAX executada com sucesso', response);
            // Manipule a resposta aqui
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição AJAX', error);
        }
    });
}, 60000);
    });
</script>
@include('app.inc.footer')