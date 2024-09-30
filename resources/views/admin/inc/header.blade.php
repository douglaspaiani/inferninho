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
      <nav id="sidebar" aria-label="Main Navigation">
        <div class="bg-header-dark">
          <div class="content-header bg-white-5"><a class="fw-semibold text-white tracking-wide" href="index.html"><span class="smini-visible"> D<span class="opacity-75">x</span></span><span class="smini-hidden"> Infer<span class="opacity-75">ninho</span></span></a>
            <div><button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#dark-mode-toggler" data-class="far fa" onclick="Dashmix.layout('dark_mode_toggle');"><i class="far fa-moon" id="dark-mode-toggler"></i></button><button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout" data-action="sidebar_close"><i class="fa fa-times-circle"></i></button></div>
          </div>
        </div>
        <div class="js-sidebar-scroll">
          <div class="content-side">
            <ul class="nav-main">
              <li class="nav-main-item"><a class="nav-main-link @if(Route::currentRouteName() == 'admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}"><i class="nav-main-link-icon fa fa-house"></i><span class="nav-main-link-name">Dashboard</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link @if(Route::currentRouteName() == 'admin.creators') active @endif" href="{{ route('admin.creators') }}"><i class="nav-main-link-icon fa-solid fa-video"></i><span class="nav-main-link-name">Criadores</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link @if(Route::currentRouteName() == 'admin.subscribers') active @endif" href="{{ route('admin.subscribers') }}"><i class="nav-main-link-icon fa-solid fa-users"></i><span class="nav-main-link-name">Assinantes</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-coins"></i><span class="nav-main-link-name">Faturamento</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-sack-dollar"></i><span class="nav-main-link-name">Saques</span><span class="nav-main-link-badge badge rounded-pill bg-primary">8</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-circle-check"></i><span class="nav-main-link-name">Assinaturas</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-heart-circle-plus"></i><span class="nav-main-link-name">Mimos</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-lock"></i><span class="nav-main-link-name">Fotos privadas</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link @if(Route::currentRouteName() == 'admin.banned') active @endif" href="{{ route('admin.banned') }}"><i class="nav-main-link-icon fa-solid fa-ban"></i><span class="nav-main-link-name">Banimentos</span></a></li>
              <li class="nav-main-heading">Suporte</li>
              <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-envelope"></i><span class="nav-main-link-name">Chamados</span><span class="nav-main-link-badge badge rounded-pill bg-primary">8</span></a></li>
              <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-circle-exclamation"></i><span class="nav-main-link-name">Denúncias</span><span class="nav-main-link-badge badge rounded-pill bg-primary">8</span></a></li>
            </ul>
          </div>
        </div>
      </nav>
      <header id="page-header">
        <div class="content-header">
          <div class="space-x-1"><button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle"><i class="fa fa-fw fa-bars"></i></button><button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="header_search_on"><i class="fa fa-fw opacity-50 fa-search"></i><span class="ms-1 d-none d-sm-inline-block">Procurar usuário...</span></button></div>
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