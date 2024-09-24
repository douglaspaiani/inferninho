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
    <form class="newPost" method="POST" action="{{ route('editPost', ['id' => $post->id]) }}" enctype="multipart/form-data">
        @csrf
        <textarea class="description-post" name="description" placeholder="Escreva uma descrição para essa publicação..." autofocus>{{ $post->description }}</textarea>
        <button type="submit" class="button send"><i class="fa-solid fa-floppy-disk"></i> <span>Salvar alterações</span></button>
    </form>
</div>
</div>
<script>
    $(document).ready(function(){
        $('.description-post').select();
    });
</script>
@include('app.inc.footer')