
@include('admin.inc.header')
  <main id="main-container">
<div class="content">
  <div class="d-md-flex justify-content-md-between align-items-md-center py-3 pt-md-3 pb-md-0 text-center text-md-start">
    <div>
      <h1 class="h3 mb-1">
        Faturamento
      </h1>
      <p class="fw-medium mb-0 text-muted">
        Central de faturamento e relatórios do {{ env('APP_NAME') }}!
      </p>
    </div>
  </div>
</div>
<div class="content">
  <div class="row">
    <form class="row" method="GET" class="filter-rel">
    <div class="col-lg-8 col-xl-5">
      <div class="mb-4">
        <label class="form-label" for="month">Selecione um mês</label>
        <select class="form-select" id="month" name="month" required>
          <option value="01" @if($month == '01') selected @endif>Janeiro</option>
          <option value="02" @if($month == '02') selected @endif>Fevereiro</option>
          <option value="03" @if($month == '03') selected @endif>Março</option>
          <option value="04" @if($month == '04') selected @endif>Abril</option>
          <option value="05" @if($month == '05') selected @endif>Maio</option>
          <option value="06" @if($month == '06') selected @endif>Junho</option>
          <option value="07" @if($month == '07') selected @endif>Julho</option>
          <option value="08" @if($month == '08') selected @endif>Agosto</option>
          <option value="09" @if($month == '09') selected @endif>Setembro</option>
          <option value="10" @if($month == '10') selected @endif>Outubro</option>
          <option value="11" @if($month == '11') selected @endif>Novembro</option>
          <option value="12" @if($month == '12') selected @endif>Dezembro</option>
        </select>
      </div>
    </div>
    <div class="col-lg-8 col-xl-5">
      <div class="mb-4">
        <label class="form-label" for="year">Selecione um ano</label>
        <select class="form-select" id="year" name="year" required>
          @for ($x = 2024; $x <= date('Y'); $x++)
          <option value="{{ $x }}" @if($year == $x) selected @endif>{{ $x }}</option>
          @endfor
        </select>
      </div>
    </div>
    <div class="col-lg-2 col-xl-2">
      <button type="submit" style="margin-top:23px" class="btn btn-hero btn-danger js-click-ripple-enabled">Filtrar</button>
    </div>
    </form>
  </div>
  <div class="row items-push">
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="fa fa-video fa-lg text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">{{ number_format($creators['current'], 0, ',', '.') }}</div>
          <div class="text-muted mb-3">Criadores ativos</div>
          @if($creators['evo'] >= 0)
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
            <i class="fa fa-caret-up me-1"></i>
            {{ $creators['evo'] }} %
          </div>
          @else
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
            <i class="fa fa-caret-down me-1"></i>
            {{ $creators['evo'] }} %
          </div>
          @endif
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
          <div class="fs-1 fw-bold">{{ number_format($subscribers['current'], 0, ',', '.') }}</div>
          <div class="text-muted mb-3">Assinantes cadastrados</div>
          @if($subscribers['evo'] >= 0)
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
            <i class="fa fa-caret-up me-1"></i>
            {{ $subscribers['evo'] }} %
          </div>
          @else
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
            <i class="fa fa-caret-down me-1"></i>
            {{ $subscribers['evo'] }} %
          </div>
          @endif
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
          <div class="fs-1 fw-bold">{{ number_format($subscriptions['current'], 0, ',', '.') }}</div>
          <div class="text-muted mb-3">Assinaturas ativas</div>
          @if($subscriptions['evo'] >= 0)
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
            <i class="fa fa-caret-up me-1"></i>
            {{ $subscriptions['evo'] }} %
          </div>
          @else
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
            <i class="fa fa-caret-down me-1"></i>
            {{ $subscriptions['evo'] }} %
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="fa fa-heart fa-lg text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">{{ number_format($countGifts['current'], 0, ',', '.') }}</div>
          <div class="text-muted mb-3">Mimos enviados</div>
          @if($countGifts['evo'] >= 0)
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
            <i class="fa fa-caret-up me-1"></i>
            {{ $countGifts['evo'] }} %
          </div>
          @else
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
            <i class="fa fa-caret-down me-1"></i>
            {{ $countGifts['evo'] }} %
          </div>
          @endif
        </div>
        <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
          <a class="fw-medium" href="{{ route('admin.gifts') }}">
            Ver todos os mimos
            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 d-flex flex-column">
      <div class="block block-rounded">
        <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
          <div class="me-3">
            <p class="fs-3 fw-bold mb-0">
              {{ number_format($views['current'], 0, ',', '.') }}
            </p>
            <p class="text-muted mb-0">
              Visualizações
            </p>
            @if($views['evo'] >= 0)
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
            <i class="fa fa-caret-up me-1"></i>
            {{ $views['evo'] }} %
          </div>
          @else
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
            <i class="fa fa-caret-down me-1"></i>
            {{ $views['evo'] }} %
          </div>
          @endif
          </div>
          <div class="item rounded-circle bg-body">
            <i class="fa fa-eye fa-lg text-primary"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex flex-column">
      <div class="block block-rounded">
        <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
          <div class="me-3">
            <p class="fs-3 fw-bold mb-0">
              R$ {{ number_format($invoiceSubs['current'], 2, ',', '.'); }}
            </p>
            <p class="text-muted mb-0">
              Receita bruta com assinaturas
            </p>
            @if($invoiceSubs['evo'] >= 0)
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
            <i class="fa fa-caret-up me-1"></i>
            {{ $invoiceSubs['evo'] }} %
          </div>
          @else
          <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
            <i class="fa fa-caret-down me-1"></i>
            {{ $invoiceSubs['evo'] }} %
          </div>
          @endif
          </div>
          <div class="item rounded-circle bg-body">
            <i class="fa-solid fa-sack-dollar fa-lg text-primary"></i>
          </div>
        </div>
      </div>
    </div>    
<div class="col-md-4 d-flex flex-column">
  <div class="block block-rounded">
    <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
      <div class="me-3">
        <p class="fs-3 fw-bold mb-0 text-success">
          R$ {{ ComissionAdmin($invoiceSubs['current']); }}
        </p>
        <p class="text-muted mb-0">
          Receita líquida com assinaturas
        </p>
        @if($invoiceSubs['evo'] >= 0)
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
        <i class="fa fa-caret-up me-1"></i>
        {{ $invoiceSubs['evo'] }} %
      </div>
      @else
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
        <i class="fa fa-caret-down me-1"></i>
        {{ $invoiceSubs['evo'] }} %
      </div>
      @endif
      </div>
      <div class="item rounded-circle bg-body">
        <i class="fa-solid fa-sack-dollar fa-lg text-primary"></i>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4 d-flex flex-column">
  <div class="block block-rounded">
    <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
      <div class="me-3">
        <p class="fs-3 fw-bold mb-0">
          R$ {{ number_format($photos['current'], 2, ',', '.'); }}
        </p>
        <p class="text-muted mb-0">
          Receita bruta com fotos privadas
        </p>
        @if($photos['evo'] >= 0)
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
        <i class="fa fa-caret-up me-1"></i>
        {{ $photos['evo'] }} %
      </div>
      @else
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
        <i class="fa fa-caret-down me-1"></i>
        {{ $photos['evo'] }} %
      </div>
      @endif
      </div>
      <div class="item rounded-circle bg-body">
        <i class="fa-regular fa-image fa-lg text-primary"></i>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4 d-flex flex-column">
  <div class="block block-rounded">
    <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
      <div class="me-3">
        <p class="fs-3 fw-bold mb-0 text-success">
          R$ {{ ComissionAdmin($photos['current']); }}
        </p>
        <p class="text-muted mb-0">
          Receita líquida com fotos privadas
        </p>
        @if($photos['evo'] >= 0)
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
        <i class="fa fa-caret-up me-1"></i>
        {{ $photos['evo'] }} %
      </div>
      @else
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
        <i class="fa fa-caret-down me-1"></i>
        {{ $photos['evo'] }} %
      </div>
      @endif
      </div>
      <div class="item rounded-circle bg-body">
        <i class="fa-regular fa-image fa-lg text-primary"></i>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4 d-flex flex-column">
  <div class="block block-rounded">
    <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
      <div class="me-3">
        <p class="fs-3 fw-bold mb-0">
          R$ {{ number_format($gifts['current'], 2, ',', '.'); }}
        </p>
        <p class="text-muted mb-0">
          Receita bruta com mimos
        </p>
        @if($gifts['evo'] >= 0)
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
        <i class="fa fa-caret-up me-1"></i>
        {{ $gifts['evo'] }} %
      </div>
      @else
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
        <i class="fa fa-caret-down me-1"></i>
        {{ $gifts['evo'] }} %
      </div>
      @endif
      </div>
      <div class="item rounded-circle bg-body">
        <i class="fa-solid fa-gift fa-lg text-primary"></i>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4 d-flex flex-column">
  <div class="block block-rounded">
    <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
      <div class="me-3">
        <p class="fs-3 fw-bold mb-0 text-success">
          R$ {{ ComissionAdmin($gifts['current']); }}
        </p>
        <p class="text-muted mb-0">
          Receita líquida com mimos
        </p>
        @if($gifts['evo'] >= 0)
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-dark">
        <i class="fa fa-caret-up me-1"></i>
        {{ $gifts['evo'] }} %
      </div>
      @else
      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
        <i class="fa fa-caret-down me-1"></i>
        {{ $gifts['evo'] }} %
      </div>
      @endif
      </div>
      <div class="item rounded-circle bg-body">
        <i class="fa-solid fa-gift fa-lg text-primary"></i>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
  </main>

  @include('admin.inc.footer')