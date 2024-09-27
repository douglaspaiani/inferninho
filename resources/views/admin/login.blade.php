
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Dashmix - Bootstrap 5 Admin Template &amp; UI Framework</title>

    <meta name="description" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ URL::asset('admin/assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('admin/assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('admin/assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Dashmix framework -->
    <link rel="stylesheet" id="css-main" href="{{ URL::asset('admin/assets/css/dashmix.min.css') }}">

    <link rel="stylesheet" id="css-theme" href="{{ URL::asset('admin/assets/css/themes/xplay.min.css') }}">
    <!-- END Stylesheets -->
  </head>

  <body>
    <div id="page-container">

      <!-- Main Container -->
      <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{ URL::asset('admin/assets/media/photos/photo19@2x.jpg') }}');">
          <div class="row g-0 justify-content-center bg-primary-dark-op">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
              <!-- Sign In Block -->
              <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                  <!-- Header -->
                  <div class="mb-2 text-center">
                    <a class="link-fx fw-bold fs-1" href="index.html">
                      <span class="text-dark">Infer</span><span class="text-primary">ninho</span>
                    </a>
                    <p class="text-uppercase fw-bold fs-sm text-muted">Administração</p>
                    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
      <p class="mb-0">{{ $error }}</p>
    </div>
    @endforeach
@endif
                  </div>
                  <!-- END Header -->

                  <!-- Sign In Form -->
                  <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                  <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                  <form class="js-validation-signin" action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                      <div class="input-group input-group-lg">
                        <input type="text" class="form-control" id="login-username" name="user" placeholder="Usuário administrativo" required>
                        <span class="input-group-text">
                          <i class="fa fa-user-circle"></i>
                        </span>
                      </div>
                    </div>
                    <div class="mb-4">
                      <div class="input-group input-group-lg">
                        <input type="password" class="form-control" id="login-password" name="password" placeholder="Senha" required>
                        <span class="input-group-text">
                          <i class="fa fa-asterisk"></i>
                        </span>
                      </div>
                    </div>
                    <div class="text-center mb-4">
                      <button type="submit" class="btn btn-hero btn-primary">
                        <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Acessar
                      </button>
                    </div>
                  </form>
                  <!-- END Sign In Form -->
                </div>
                <div class="block-content bg-body text-center">
                  
                  <p style="font-size:12px">{{ date('Y') }} &copy; Inferninho | Todos os direitos reservados. | Powered by <a href="https://douglaspaiani.com.br" target="blank">Douglas Paiani</a></p>
                </div>
              </div>
              <!-- END Sign In Block -->
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <script src="{{ URL::asset('admin/assets/js/dashmix.app.min.js') }}"></script>

    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="{{ URL::asset('admin/assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ URL::asset('admin/assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ URL::asset('admin/assets/js/pages/op_auth_signin.min.js') }}"></script>
  </body>
</html>
