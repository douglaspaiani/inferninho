<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Administração Inferninho</title>
    <link rel="shortcut icon" href="{{ URL::asset('admin/assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('admin/assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('admin/assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <link rel="stylesheet" id="css-main" href="{{ URL::asset('admin/assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ URL::asset('admin/assets/css/themes/xplay.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
  </head>
  <body>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow side-trans-enabled page-header-dark dark-mode">
      <aside id="side-overlay"></aside>
      <x-sidebar-component/>
      <header id="page-header">
        <div class="content-header">
          <div class="space-x-1"><button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle"><i class="fa fa-fw fa-bars"></i></button><!--<button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="header_search_on"><i class="fa fa-fw opacity-50 fa-search"></i><span class="ms-1 d-none d-sm-inline-block">Procurar usuário...</span></button>--></div>
          <div class="space-x-1">
            <div class="dropdown d-inline-block"><button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-user d-sm-none"></i><span class="d-none d-sm-inline-block">Administrador</span><i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i></button>
              <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3"> Opções do usuário </div>
                <div class="p-2"><a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle"><i class="far fa-fw fa-building me-1"></i> Configurações </a>
                  <div role="separator" class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="far fa-fw fa-arrow-alt-circle-left me-1"></i> Sair do painel </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="page-header-search" class="overlay-header bg-header-dark">
          <div class="bg-white-10">
            <div class="content-header">
              <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group"><button type="button" class="btn btn-alt-primary" data-toggle="layout" data-action="header_search_off"><i class="fa fa-fw fa-times-circle"></i></button><input type="text" class="form-control border-0" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input"></div>
              </form>
            </div>
          </div>
        </div>
        <div id="page-header-loader" class="overlay-header bg-header-dark">
          <div class="bg-white-10">
            <div class="content-header">
              <div class="w-100 text-center"><i class="fa fa-fw fa-sun fa-spin text-white"></i></div>
            </div>
          </div>
        </div>
      </header>