@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
<a href="{{ route('home') }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
<a href="{{ $user['link'] }}" class="right"><i class="fa-solid fa-user" style="margin-right:8px"></i> Ver meu perfil</a>
                <h2 class="title" style="margin-top: 50px">Editar perfil</h2>
                <div class="AddCard boxContent">
                    <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-form input-upload">
                            <label class="label" for="username" style="text-align: center;margin-top:30px">Foto de perfil</label>
                            <span id="photo-profile" class="photo-profile" style="background-image:url('{{ $user['photo'] }}')">
                            <input type="file" id="upload-photo" name="photo" style="display: none">
                            <button type="button" id="btn-upload-profile" class="btn-upload"><i class="fa-solid fa-camera"></i></button>
                        </div>
                        <div class="input-form input-mock">
                            <label class="label" for="username">Nome de usuário</label>
                            <span class="mock">{{ env('USER_URL') }}/</span><input type="text" oninput="transformUsername()" class="input" id="username" name="username" placeholder="/seu-usuario" value="{{ $user['user'] }}" required></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="description">Descrição do perfil</label>
                            <textarea class="input" id="description" name="description" placeholder="Escreva uma descrição para o seu perfil...">{{ $user['description'] }}</textarea>
                        </div>
                        <h2 class="title" style="margin-top: 50px">Redes sociais</h2>
                        <div class="input-form">
                            <label class="label" for="tiktok">Tiktok</label>
                            <input type="url" class="input" name="tiktok" id="tiktok" placeholder="Insira o link do Tiktok" value="{{ $user['tiktok'] }}"></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="instagram">Instagram</label>
                            <input type="url" class="input" name="instagram" id="instagram" placeholder="Insira o link do Instagram" value="{{ $user['instagram'] }}"></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="facebook">Facebook</label>
                            <input type="url" class="input" name="facebook" id="facebook" placeholder="Insira o link do Facebook" value="{{ $user['facebook'] }}"></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="twitter">Twitter</label>
                            <input type="url" class="input" name="twitter" id="twitter" placeholder="Insira o link do Twitter" value="{{ $user['twitter'] }}"></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="telegram">Telegram</label>
                            <input type="url" class="input" name="telegram" id="telegram" placeholder="Insira o link do Telegram" value="{{ $user['telegram'] }}"></input>
                        </div>
                        <div class="input-form">
                            <label class="label" for="site">Site personalizado</label>
                            <input type="url" class="input" name="site" id="site" placeholder="Insira o link do site" value="{{ $user['site'] }}"></input>
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