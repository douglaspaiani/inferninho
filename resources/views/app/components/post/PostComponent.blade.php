<div class="Post post-{{ $id }}" id="app">
    @if (Route::currentRouteName() == 'home' && $public == 1 || Route::currentRouteName() == 'post' && $public == 1)
        <div class="promote"><i class="fa-solid fa-fire-flame-curved"></i> Promovido <i class="fa-solid fa-fire-flame-curved"></i></div>
    @endif
    @if($user_id == Auth::id())
    <div id="options-post" data-id="{{ $id }}" class="Menu menu-post">
        <a href="{{ route('editPost', ['id' => $id]) }}" class="edit"><i class="fa-solid fa-pen"></i> Editar descrição</a>
        <a href="#" class="delete openNotify" data-notify="DeletePost" data-id="{{ $id }}"><i class="fa-solid fa-trash-can"></i> Apagar postagem</a>
    </div>
    <button type="button" data-id="{{ $id }}" class="options-post"><i class="fa-solid fa-ellipsis-vertical"></i></button>
    @endif
    <div class="UserLine">
        <div class="img">
            <a href="{{ $link }}"><span class="img-profile" style="background-image:url('{{ $photo }}" alt="{{ $name }}')"></span></a>
        </div>
        <div class="user">
            <a href="{{ $link }}"><span>{{ $name }}
                @if($verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </span></a>
            
            <a href="{{ $link }}"><i>{{ $user }}</i></a>
            <p class="date-posting">Postado {{ $date }}</p>
        </div>
    </div>
    <div class="posting">
        @if(!empty($description))
        <div class="description">
            {{ $description }}
        </div>
        @endif
        @if($value > 0 && $sold == 0 && session('admin') != true)
        <div class="imgpost">
            <div class="buy">
                <i class="fa-regular fa-eye-slash"></i>
                <h4>FOTO PRIVADA</h4>
                <p>Compre essa foto por apenas</p>
                <span>R$ {{ number_format($value, 2, ',', '.') }}</span>
                <a href="{{ route('payment-photo', ['id' => $id]) }}">Comprar agora</a>
            </div>
            @if(!empty($image))
                @foreach ($images as $photo)
                    <span class="image" style="background-image: url('{{ $photo_url }}{{ $photo }}')"></span>
                @endforeach
            @endif
        </div>
        @else
        <div class="imgPost">
            @if(!empty($image))
                @foreach ($images as $photo)
                    <span class="image" style="background-image: url('{{ $photo_url }}{{ $photo }}')">
                        @if($timer == 1)
                        <div class="timer"><i class="fa-solid fa-stopwatch"></i></div>
                        @endif
                    </span>
                @endforeach
            @endif
        </div>
        @endif
        @if (Route::currentRouteName() == 'home' && $public == 1 || Route::currentRouteName() == 'post' && $public == 1)
            <div class="public">
                <h4>Assine esse perfil!</h4>
                <span>Por apenas <b>R$ {{ number_format($price, 2, ',', '.')  }}</b></span>
                <a href="{{ $link }}">Ver perfil</a>
            </div>
        @endif
        @if($value == 0 || $sold == 1)
        <div class="infos">
            <button id="like-{{ $id }}" type="button" class="like button-like" onclick="likePost({{ $id }}, {{ $likes }});">
                <i class="fa-regular fa-heart"></i> <span>{{ $likes }}</span>
            </button>
            @if($nocomments == 0)
            <a href="{{ route('post', ['id' => $id]) }}" class="button-like button-comment">
                <i class="fa-regular fa-comment"></i> <span>{{ $countComments }}</span>
            </a>
            @endif
            <a href="#" class="button-like"><i class="fa-solid fa-dollar-sign"></i> <span>Enviar um mimo</span></a>
        </div>
        @endif
    </div>
    @if (Route::currentRouteName() == 'post' && $value == 0)
    @if(count($comments) > 0 && $nocomments == 0)
        <div class="comments">
            <h6>Mais recentes</h6>
            @foreach($comments as $comment)
            <div class="commentUser @if($comment->view == 0) notview @endif" id="comment-{{ $comment->id }}">
                <a href="@if($comment->creator == 1) {{ route('username', ['username' => $comment->username]) }} @else # @endif" @if($comment->creator == 0) style="pointer-events: none;" @endif><span class="img" style="background-image:url('{{ !empty($comment->photo) ? env('PROFILE_IMG').$comment->photo : env('APP_URL')."/app/images/user-default.jpg"; }}')"></span></a>
                <div class="infos">
                    <a href="@if($comment->creator == 1) {{ route('username', ['username' => $comment->username]) }} @else # @endif" @if($comment->creator == 0) style="pointer-events: none;" @endif><span class="name">
                        @if($comment->hidden_name == 1)
                        Usuário anônimo
                        @else
                        {{ $comment->name }} 
                        @endif
                        @if($comment->verify == 1)
                        <i class="verify fa-solid fa-circle-check"></i>
                        @endif
                        @if($comment->top == 1)
                        <i class="king fa-solid fa-crown"></i>
                        @endif</span></a>
                    <p class="txt">{{ $comment->comment }}</p>
                    <span class="time"><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                </div>
                @if($comment->subscriber == Auth::id())
                <button type="button" class="options" data-id="{{ $comment->id }}"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <div id="options-comment" data-id="{{ $comment->id }}" class="Menu option-menu">
                    <a href="#" class="edit openNotify" data-notify="EditComment" data-id="{{ $comment->id }}"><i class="fa-solid fa-pen"></i> Editar comentário</a>
                    <a href="#" class="delete" data-id="{{ $comment->id }}"><i class="fa-solid fa-trash-can"></i> Apagar comentário</a>
                </div>
                @endif
                @if($comment->user == Auth::id() && $comment->subscriber != Auth::id())
                <button type="button" class="options" data-id="{{ $comment->id }}"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <div id="options-comment" data-id="{{ $comment->id }}" class="Menu option-menu">
                    <a href="#" class="delete" data-id="{{ $comment->id }}"><i class="fa-solid fa-trash-can"></i> Apagar comentário</a>
                </div>
                @endif
            </div>
            @endforeach

        </div>
    @else
    <p class="empty">Seja o primeiro a comentar!</p>
    @endif
        <div class="comment">
            <form method="POST" action="{{ route('post', ['id' => $id]) }}">
                @csrf
                <textarea class="input" id="comment" name="comment" placeholder="Escreva um comentário..." required></textarea>
                <div class="button btn-loading">
                    <i class="fa-regular fa-paper-plane"></i>
                    <button type="submit"><span>Publicar comentário</span></button>
                </div>
            </form>
        </div>
    @endif
</div>

<div id="EditComment" class="notification">
    <h4>Editar comentário</h4>
    <div class="content">
        <textarea class="input" name="comment" placeholder="Edite seu comentário..." required></textarea>
    </div>
    <button type="button" data-id="0" class="confirm">Salvar alteração</button>
    <button type="button" class="cancel">Cancelar</button>
</div>
<div id="DeleteComment" class="notification">
    <h4>Deseja apagar seu comentário?</h4>
    <button type="button" data-id="0" class="confirm">Sim, apagar.</button>
    <button type="button" class="cancel">Cancelar</button>
</div>
<div id="DeletePost" class="notification">
    <h4>Deseja mesmo apagar essa postagem?</h4>
    <button type="button" data-id="0" class="confirm">Sim, apagar.</button>
    <button type="button" class="cancel">Cancelar</button>
</div>