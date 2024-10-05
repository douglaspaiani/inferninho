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
          <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-heart-circle-plus"></i><span class="nav-main-link-name">Mimos</span></a></li>
          <li class="nav-main-item"><a class="nav-main-link @if(Route::currentRouteName() == 'admin.banned') active @endif" href="{{ route('admin.banned') }}"><i class="nav-main-link-icon fa-solid fa-ban"></i><span class="nav-main-link-name">Banimentos</span></a></li>
          <li class="nav-main-heading">Suporte</li>
          <li class="nav-main-item"><a class="nav-main-link @if(Route::currentRouteName() == 'admin.support') active @endif" href="{{ route('admin.support') }}"><i class="nav-main-link-icon fa-solid fa-envelope"></i><span class="nav-main-link-name">Chamados</span>
            @if($countSupport > 0)
            <span class="nav-main-link-badge badge rounded-pill bg-primary">{{ $countSupport }}</span>
            @endif
        </a></li>
          <li class="nav-main-item"><a class="nav-main-link" href="be_pages_dashboard.html"><i class="nav-main-link-icon fa-solid fa-circle-exclamation"></i><span class="nav-main-link-name">Denúncias</span><span class="nav-main-link-badge badge rounded-pill bg-primary">8</span></a></li>
        </ul>
      </div>
    </div>
  </nav>