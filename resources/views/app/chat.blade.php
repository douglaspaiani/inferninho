@include('app.inc.header')

<x-navbar-component/>

<div class="container page chatpage">
    <div class="chatBar">
        <a href="{{ route('messages') }}" class="back"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="user">
            <h4>{{ $user->name }} 
                @if($user->verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($user->top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif</h4>
        @if(str_replace('@', '', $user->username))
            <a href="{{ route('username', ['username' => str_replace('@', '', $user->username)]) }}"><span class="img-profile" style="background-image:url('{{ $user->photo }}')"></span></a>
            @else
            <a href="#"><span class="img-profile" style="background-image:url('{{ URL::asset('app/images/user-default.jpg'); }}')"></span></a>
            @endif
        </div>
    </div>

    <div id="chat-box">
        @if(count($messages) == 0)
        <div class="empty">Vocês ainda não iniciaram uma conversa.</div>
        @endif
        <?php $num = 0; ?>
        @foreach($messages as $msg)
        <div class="line @if($msg->sender == Auth::id()) my-line <?php $num++; ?>  @else <?php $num = 0; ?> @endif">
            <div class="message @if($msg->sender == Auth::id()) me  @endif"><p>{{ $msg->message }}</p></div>
        </div>
        @endforeach
    </div>
    
    <form id="chat-form">
        @csrf
        <div class="message-box">
            <input type="hidden" id="flood" value="{{ $num }}">
            @if($num == 5)
            <div class="empty">Aguarde uma resposta do usuário.</div>
            @else
            <input type="text" id="message-input" placeholder="Escreva sua mensagem...">
            <button class="snd" type="submit"><i class="fa-regular fa-paper-plane"></i></button>
            @endif
        </div>
    </form>

</div>

@include('app.inc.footer')