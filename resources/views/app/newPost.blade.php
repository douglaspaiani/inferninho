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
        <textarea class="description-post" name="description" placeholder="Escreva uma descrição para essa publicação..." autofocus></textarea>
        <input type="file" name="photos[]" id="photos" style="display: none" multiple accept="image/*">
        <div id="imagePreview"></div>
        <div class="buttons">
            <button type="button" id="btn-add-photo"><i class="fa-solid fa-camera"></i><span>Selecionar até 5 fotos</span></button>
            <button type="button"><i class="fa-solid fa-video"></i><span>Selecione 1 vídeo</span></button>
        </div>
        <button type="submit" class="button"><i class="fa-solid fa-paper-plane"></i> Postar conteúdo</button>
    </form>
</div>
</div>

@include('app.inc.footer')