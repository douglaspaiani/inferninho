@include('app.inc.header')

<x-navbar-component/>

<div class="container page">
<a href="{{ route('home') }}" class="Back"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
<a href="{{ route('home') }}" class="right"><i class="fa-solid fa-user" style="margin-right:8px"></i> Ver meu perfil</a>
                <h2 class="title" style="margin-top: 50px">Editar perfil</h2>
                <div class="AddCard">
                    <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-form input-upload">
                            <label class="label" htmlFor="username">Foto de perfil</label>
                            <span id="photo-profile" class="photo-profile" style="background-image:url('{{ $user['photo'] }}')">
                            <input type="file" id="upload-photo" name="photo" style="display: none">
                            <button type="button" id="btn-upload-profile" class="btn-upload"><i class="fa-solid fa-camera"></i></button>
                        </div>
                        <div class="input-form input-mock">
                            <label class="label" htmlFor="username">Nome de usuário</label>
                            <span class="mock">{{ env('USER_URL') }}/</span><input type="text" oninput="transformUsername()" class="input" id="username" name="username" placeholder="/seu-usuario" value="{{ $user['username'] }}" required></input>
                        </div>
                        <div class="input-form">
                            <label class="label" htmlFor="description">Descrição do perfil</label>
                            <textarea class="input" id="description" name="description" placeholder="Escreva uma descrição para o seu perfil...">{{ $user['description'] }}</textarea>
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