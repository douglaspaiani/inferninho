@include('admin.inc.header')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Banir usuário</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active" aria-current="page">Banir usuário</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    <div class="content">
      <x-errors-admin-component/>

      <div class="row">
        <div class="col-md-8 col-xl-8">
            <!-- Alternative Project #1 -->
            <div class="block block-rounded h-100 mb-0">
              <div class="block-content bg-gd-primary py-6 text-center">
                <h3 class="fs-4 fw-bold mb-1">
                  <a class="text-white link-fx" href="javascript:void(0)">{{ $user->name }}</a>
                </h3>
                <h4 class="fs-6 text-white-75 mb-0">{{ $user->email }}</h4>
              </div>
              @if($user->creator == 1)
              <div class="block-content block-content-full text-center bg-body-light">
                <a href="{{ route('username', ['username' => str_replace('@', '', $user->username)]) }}" target="blank" class="badge bg-danger text-uppercase fw-bold py-2 px-3">{{ $user->username }}</a>
              </div>
              @endif
              <div class="block-content block-content-full bg-body-light">
                <div class="row g-sm">
                  <div class="col-6">
                    <a class="btn btn-danger btn-sm w-100" href="{{ route('admin.confirm-ban', ['id' => $user->id]) }}">
                      <i class="fa fa-ban me-1"></i> Banir este usuário
                    </a>
                  </div>
                  <div class="col-6">
                    <a class="btn btn-sm w-100 btn-alt-secondary" href="{{ route('admin.banned') }}">
                      Cancelar
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- END Alternative Project #1 -->
          </div>
      </div>
    </div>
</main>
@include('admin.inc.footer')