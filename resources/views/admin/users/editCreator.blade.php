@include('admin.inc.header')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Editar criador</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Criadores</li>
                <li class="breadcrumb-item active" aria-current="page">Editar criador</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="content mb-5 mt-4">
        <x-errors-admin-component/>
        <form method="POST" action="">
            @csrf
            <div class="row">
            <div class="col-sm-4">
              <div class="mb-4">
                <label class="form-label" for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Nome" required>
              </div>
              <div class="mb-4">
                <label class="form-label" for="password">Nova senha (preencha para alterar)</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="Crie uma nova senha">
              </div>
              <div class="mb-4">
                <label class="form-label" for="cpf">CPF</label>
                <input type="text" class="form-control cpf" id="cpf" name="cpf" value="{{ $user->cpf }}" placeholder="CPF" required>
              </div>
              <div class="mb-4">
                <label class="form-label" for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="E-mail" required>
              </div>
              <div class="mb-4">
                <label class="form-label" for="username">Nome de usuário</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ str_replace('@', '', $user->username) }}" placeholder="Username" required>
              </div>
              <div class="mb-4">
                <label class="form-label" for="description">Descrição do perfil</label>
                <textarea class="form-control" id="description" name="description" style="height: 200px" placeholder="Descrição do perfil">{{ $user->description }}</textarea>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-4">
                <label class="form-label" for="facebook">Facebook</label>
                <input type="url" class="form-control" id="facebook" name="facebook" value="{{ $user->facebook }}" placeholder="Facebook">
              </div>
              <div class="mb-4">
                <label class="form-label" for="instagram">Instagram</label>
                <input type="url" class="form-control" id="instagram" name="instagram" value="{{ $user->instagram }}" placeholder="Instagram">
              </div>
              <div class="mb-4">
                <label class="form-label" for="twitter">Twitter</label>
                <input type="url" class="form-control" id="twitter" name="twitter" value="{{ $user->twitter }}" placeholder="Twitter">
              </div>
              <div class="mb-4">
                <label class="form-label" for="tiktok">Tiktok</label>
                <input type="url" class="form-control" id="tiktok" name="tiktok" value="{{ $user->tiktok }}" placeholder="Tiktok">
              </div>
              <div class="mb-4">
                <label class="form-label" for="telegram">Telegram</label>
                <input type="url" class="form-control" id="telegram" name="telegram" value="{{ $user->telegram }}" placeholder="Telegram">
              </div>
              <div class="mb-4">
                <label class="form-label" for="site">Site</label>
                <input type="url" class="form-control" id="site" name="site" value="{{ $user->site }}" placeholder="Site">
              </div>
              <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" id="verify" name="verify" @if($user->verify == 1) checked @endif>
                  <label class="form-check-label" for="verify"><i class="fa-solid fa-circle-check" style="color: rgb(0, 145, 255);"></i> Perfil verificado</label>
                </div>
              </div>
              <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" id="top" name="top" @if($user->top == 1) checked @endif>
                  <label class="form-check-label" for="top"><i class="fa-solid fa-crown" style="color: rgb(255, 217, 0);"></i> Entre os Tops</label>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Informações</h3>
                </div>
                <div class="block-content">
                  <center><span class="mb-4" style="background-image:url({{ $user->photo }});width:100px;height:100px;display:block;background-position:center;background-size:cover;border-radius:100px"></span></center>
                  <ul class="list-group push">
                    <li class="list-group-item"><b>Assinantes ativos:</b> {{ $count_subscribers }}</li>
                    <li class="list-group-item"><b>Perfil:</b> <a target="blank" href="{{ route('username', ['username' => str_replace('@', '', $user->username)]) }}">Acessar</a></li>
                    <li class="list-group-item"><b>Nascimento:</b> {{ \Carbon\Carbon::parse($user->birth)->format('d/m/Y') }}</li>
                    <li class="list-group-item"><b>Cadastro:</b> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</li>
                    <li class="list-group-item"><b>PIX:</b> {{ $user->pix ?? '(Não informado)' }}</li>
                    <li class="list-group-item"><b>Saldo:</b> R$ 100,00</li>
                  </ul>
                </div>
              </div>
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Planos de assinaturas</h3>
                </div>
                <div class="block-content">
                  <ul class="list-group push">
                    <li class="list-group-item"><b>1 mês:</b> R$ {{ number_format($user->price_1, 2, ',', '.') }}</li>
                    <li class="list-group-item"><b>3 meses:</b> R$ {{ number_format($user->price_3, 2, ',', '.') }}</li>
                    <li class="list-group-item"><b>6 meses:</b> R$ {{ number_format($user->price_6, 2, ',', '.') }}</li>
                  </ul>
                </div>
              </div>
            </div>
            </div>
            <div class="row">
              <div class="col-sm-8 col-xl-8 text-center mt-4">
                <button type="submit" class="btn btn-hero btn-danger me-1 mb-3">
                  <i class="fa fa-fw fa-save me-1"></i> Salvar alterações
                </button>
              </div>
            </div>

        </form>
      </div>
</main>
@include('admin.inc.footer')