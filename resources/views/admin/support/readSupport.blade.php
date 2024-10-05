@include('admin.inc.header')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ $support->title }}</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Chamados</li>
                <li class="breadcrumb-item active" aria-current="page">Detalhe</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="content mb-5 mt-4">
        @foreach($messages as $msg)
        <!-- Message -->
        <div class="block block-rounded">
          <div class="block-content block-content-sm block-content-full bg-body-light">
            <div class="d-flex py-3">
              <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-right">
                @if($msg->user == 1)
                <img class="img-avatar img-avatar48" src="{{ $photo }}" alt="">
                @else
                <img class="img-avatar img-avatar48" src="{{ URL::asset('app/images/user-default.jpg') }}" alt="">
                @endif
              </div>
              <div class="flex-grow-1">
                <div class="row">
                  <div class="col-sm-7">
                    @if($msg->user == 1)
                    <a class="fw-semibold link-fx" target="blank" href="{{ route('username', ['username' => $username]) }}">{{ $name }}</a>
                    <div class="fs-sm text-muted">{{ $email }}</div>
                    @else
                    <b>Suporte do {{ env('APP_NAME') }}</b>
                    <div class="fs-sm text-muted">Atendente</div>
                    @endif
                  </div>
                  <div class="col-sm-5 d-sm-flex align-items-sm-center">
                    <div class="fs-sm text-muted text-sm-end w-100 mt-2 mt-sm-0">
                      <p class="mb-0">{{ \Carbon\Carbon::parse($msg->created_at)->format('d/m/Y') }}</p>
                      <p class="mb-0">{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="block-content">
            <p>{{ $msg->message }}</p>
          </div>
        </div>
        <!-- END Message -->
        @endforeach

        <!-- Reply -->
        <div class="block block-rounded">
          <form method="POST" action="{{ route('admin.read-support', ['id' => $support->id]) }}" class="block-content block-content-full">
            @csrf
            <!-- CKEditor 5 Classic (js-ckeditor5-classic in Helpers.jsCkeditor5()) -->
            <!-- For more info and examples you can check out http://ckeditor.com -->
            <div class="mb-4">
              <label class="form-label" for="example-textarea-input">Responda o usuário</label>
              <textarea class="form-control" id="example-textarea-input" name="message" rows="4" placeholder="Escreva uma resposta para o usuário..." required></textarea>
            </div>
            <button type="submit" class="btn btn-alt-primary mt-2">Enviar resposta</button>
          </form>
        </div>
        <!-- END Reply -->
        <div class="text-center mt-5 mb-5">
          <a href="{{ route('admin.close-support', ['id' => $support->id]) }}" class="btn btn-hero btn-danger"><i class="fa-regular fa-circle-xmark"></i> Encerrar chamado</a>
        </div>
      </div>

</main>
@include('admin.inc.footer')