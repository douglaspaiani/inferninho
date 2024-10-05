@include('admin.inc.header')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Chamados de suporte encerrados</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active" aria-current="page">Chamados encerrados</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    <div class="content">
      <x-errors-admin-component/>
        <div class="">
          @if(count($supports) > 0)
            <div class="block-content block-content-full overflow-x-auto">
              <!-- DataTables init on table by adding .js-dataTable-responsive class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
              <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 80px;">Status</th>
                    <th>Título</th>
                    <th style="width: 30%;">Usuário</th>
                    <th style="width: 15%;">Atualização</th>
                    <th style="width: 15%;">Ações</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($supports as $support)
                  <tr>
                    @if($support->status == 0)
                    <td class="text-center"><i class="fa-solid fa-circle-check" style="color: green"></i></td>
                    @else
                    @if($support->view_admin == 0)
                    <td class="text-center"><i class="fa-solid fa-triangle-exclamation" style="color: #ffa93c"></i></td>
                    @else
                    <td class="text-center"><i class="fa-solid fa-clock" style="color: #aaa"></i></td>
                    @endif
                    @endif
                    <td class="fw-semibold"><a href="{{ route('admin.read-support', ['id' => $support->id]) }}">{{ $support->title }}</a></td>
                    <td class="fw-semibold"><a target="blank" href="{{ route('username', ['username' => $support->username]) }}">{{ $support->name }}</a></td>
                    <td>
                      <span class="text-muted">{{ \Carbon\Carbon::parse($support->updated_at)->format('d/m/Y') }}</span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group me-2 mb-2" role="group" aria-label="Icons File group">
                            <a href="{{ route('admin.read-support', ['id' => $support->id]) }}" class="btn btn-sm btn-primary">
                              <i class="fa fa-fw fa-eye"></i>
                            </a>
                          </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
            
          </div>
        </div>

</main>
@include('admin.inc.footer')