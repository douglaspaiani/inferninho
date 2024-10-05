@include('admin.inc.header')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Usuários banidos</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active" aria-current="page">Banimentos</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    <div class="content">
      <x-errors-admin-component/>

      <div class="block-content block-content-full overflow-x-auto">
        <!-- DataTables init on table by adding .js-dataTable-responsive class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
          <thead>
            <tr>
              <th class="text-center" style="width: 80px;">ID</th>
              <th>Nome</th>
              <th style="width: 30%;">Email</th>
              <th style="width: 15%;">Registro</th>
              <th style="width: 15%;">Banimento</th>
              <th style="width: 15%;">Ações</th>
            </tr>
          </thead>
          <tbody>
              @foreach($users as $user)
            <tr>
              <td class="text-center">{{ $user->id }}</td>
              <td class="fw-semibold">{{ $user->name }}</td>
              <td>
                <span class="text-muted">{{ $user->email }}</span>
              </td>
              <td>
                <span class="text-muted">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</span>
              </td>
              <td>
                <span class="text-muted">{{ \Carbon\Carbon::parse($user->update_at)->format('d/m/Y') }}</span>
              </td>
              <td class="text-center">
                  <div class="btn-group me-2 mb-2" role="group" aria-label="Icons File group">
                    @if($user->creator == 1)
                    <a href="{{ route('admin.edit-creator', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-fw fa-edit"></i>
                      </a>
                    @else
                      <a href="{{ route('admin.edit-subscriber', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-fw fa-edit"></i>
                      </a>
                      @endif
                      <a href="{{ route('admin.unban', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-circle-check"></i>
                      </a>
                    </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</main>
@include('admin.inc.footer')