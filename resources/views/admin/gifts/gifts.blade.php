@include('admin.inc.header')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Mimos recebidos</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active" aria-current="page">Mimos recebidos</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    <div class="content">
      <x-errors-admin-component/>
        <div class="">
            <div class="block-content block-content-full overflow-x-auto">
              <!-- DataTables init on table by adding .js-dataTable-responsive class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
              <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Para criador</th>
                    <th style="width: 30%;">Valor</th>
                    <th style="width: 30%;">Comissão {{ env('APP_NAME') }}</th>
                    <th style="width: 15%;">Data</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($gifts as $gift)
                  <tr>
                    <td class="text-center">{{ $gift->id }}</td>
                    <td class="fw-semibold"><a href="{{ route('username', ['username' => $gift->username]) }}" target="blank">{{ $gift->name }}</a></td>
                    <td>
                      <span class="text-muted"><b>R$ {{ number_format($gift->value, 2, ',', '.'); }}</b></span>
                    </td>
                    <td>
                        <span class="text-muted"><b>R$ {{ ComissionAdmin($gift->value); }}</b></span>
                      </td>
                    <td>
                      <span class="text-muted">{{ \Carbon\Carbon::parse($gift->created_at)->format('d/m/Y - H:i') }}</span>
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