
@include('admin.inc.header')
  <main id="main-container">
<div class="content">
  <div class="d-md-flex justify-content-md-between align-items-md-center py-3 pt-md-3 pb-md-0 text-center text-md-start">
    <div>
      <h1 class="h3 mb-1">
        Dashboard
      </h1>
      <p class="fw-medium mb-0 text-muted">
        Seja bem vindo(a) á administração do Inferninho!
      </p>
    </div>
  </div>
</div>
<div class="content">
  <div class="row items-push">
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="fa fa-video fa-lg text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">{{ number_format($creators, 0, ',', '.') }}</div>
          <div class="text-muted mb-3">Criadores ativos</div>
        </div>
        <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
          <a class="fw-medium" href="{{ route('admin.creators') }}">
            Ver todos os criadores
            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="fa fa-users fa-lg text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">{{ number_format($subscribers, 0, ',', '.') }}</div>
          <div class="text-muted mb-3">Assinantes ativos</div>
        </div>
        <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
          <a class="fw-medium" href="{{ route('admin.subscribers') }}">
            Ver todos os assinantes
            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="fa fa-check-circle fa-lg text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">{{ number_format($subscriptions, 0, ',', '.') }}</div>
          <div class="text-muted mb-3">Assinaturas ativas</div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="fa fa-heart fa-lg text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">{{ number_format($subscribers, 0, ',', '.') }}</div>
          <div class="text-muted mb-3">Mimos enviados</div>
        </div>
        <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
          <a class="fw-medium" href="{{ route('admin.subscribers') }}">
            Ver todos os mimos
            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="block block-rounded block-mode-loading-refresh">
        <div class="block-header block-header-default">
          <h3 class="block-title">
            Últimos chamados
          </h3>
        </div>
        <div class="block-content">
          <table class="table table-striped table-hover table-borderless table-vcenter fs-sm">
            <thead>
              <tr class="text-uppercase">
                <th>Título do chamado</th>
                <th>Status</th>
                <th class="d-none d-xl-table-cell">Atualização</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($supports as $support)
              <tr>
                <td>
                  <span class="fw-semibold">{{ $support->title }}</span>
                </td>
                <td>
                  @if($support->view_admin == 0)
                  <span class="fw-semibold text-warning">Pendente</span>
                  @else
                  <span class="fw-semibold text-success">Aberto</span>
                  @endif
                </td>
                <td class="d-none d-xl-table-cell">
                  <span class="fs-sm text-muted">{{ \Carbon\Carbon::parse($support->updated_at)->format('d/m/Y') }}</span>
                </td>
                <td class="text-center text-nowrap fw-medium">
                  <a href="{{ route('admin.read-support', ['id' => $support->id]) }}">
                    Ver
                  </a>
                </td>
              </tr>
              @endforeach
  
            </tbody>
          </table>
        </div>
        <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-center">
          <a class="fw-medium" href="{{ route('admin.support') }}">
            Ver todos os chamados
            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex flex-column">
      <div class="block block-rounded">
        <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
          <div class="me-3">
            <p class="fs-3 fw-bold mb-0">
              {{ number_format($views, 0, ',', '.') }}
            </p>
            <p class="text-muted mb-0">
              Visualizações totais
            </p>
          </div>
          <div class="item rounded-circle bg-body">
            <i class="fa fa-eye fa-lg text-primary"></i>
          </div>
        </div>
      </div>
      <div class="block block-rounded text-center d-flex flex-column flex-grow-1">
        <div class="block-content block-content-full d-flex align-items-center flex-grow-1">
          <div class="w-100">
            <div class="item rounded-3 bg-body mx-auto my-3">
              <i class="fa-solid fa-hand-holding-dollar text-primary"></i>
            </div>
            <div class="fs-1 fw-bold">75</div>
            <div class="text-muted mb-3">Saques pendentes</div>
          </div>
        </div>
        <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
          <a class="fw-medium" href="javascript:void(0)">
            Ver saques solicitados
            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
  </main>

  @include('admin.inc.footer')