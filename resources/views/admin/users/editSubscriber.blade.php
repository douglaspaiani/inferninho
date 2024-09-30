@include('admin.inc.header')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Editar assinante</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Assinantes</li>
                <li class="breadcrumb-item active" aria-current="page">Editar assinante</li>
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
            </div>
            <div class="col-sm-4">
                <div class="mb-4">
                    <label class="form-label" for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="E-mail" required>
                  </div>
            </div>
            <div class="col-sm-4">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Informações</h3>
                </div>
                <div class="block-content">
                  <ul class="list-group push">
                    <li class="list-group-item"><b>Nascimento:</b> {{ \Carbon\Carbon::parse($user->birth)->format('d/m/Y') }}</li>
                    <li class="list-group-item"><b>Cadastro:</b> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</li>
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
        <div class="block block-rounded mt-5">
            <div class="block-header block-header-default">
              <h3 class="block-title">Assinaturas ativas do usuário ({{ count($subscribers) }})</h3>
            </div>
            <div class="block-content">
              <table class="table table-vcenter">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach($subscribers as $sub)
                    <td class="fw-semibold">
                      <a href="{{ route('username', ['username' => $sub->username]) }}" target="blank">{{ $sub->name }}</a>
                    </td>
                    <td class="d-none d-sm-table-cell">
                      <span class="badge bg-success">Ativo</span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
</main>
@include('admin.inc.footer')