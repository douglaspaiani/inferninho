@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
    <div class="Post">
    <h1 class="title">Criar nova publicação</h1>

    @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="error">
                    {{ $error }}
                </div>
                @endforeach
    @endif

    <div class="UserLine">
        <div class="img">
            <a href={url}><img src="{{ $user->photo ?? URL::asset('app/images/user-default.jpg') }}" alt="{{ $user->name }}"/></a>
        </div>
        <div class="user">
            <a href={url}><span>{{ $user->name }}
                @if($user->verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($user->top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </span></a>
            
            <a href="#"><i>{{ $user->user }}</i></a>
        </div>
    </div>
    <form class="newPost" method="POST" action="{{ route('newPost') }}" enctype="multipart/form-data">
        @csrf
        <textarea class="description-post" placeholder="Escreva uma descrição para essa publicação..." autofocus></textarea>
        <input type="file" name="photos[]" id="photos" multiple accept="image/*">
        <div class="buttons">
            <button type="button"><i class="fa-solid fa-camera"></i><span>Selecionar até 5 fotos</span></button>
            <button type="button"><i class="fa-solid fa-video"></i><span>Selecione 1 vídeo</span></button>
        </div>
        <button type="submit" class="button"><i class="fa-solid fa-plus"></i> Postar conteúdo</button>
    </form>
</div>
</div>

@include('app.inc.footer')