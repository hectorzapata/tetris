<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
  <!--begin::Menu Container-->
  <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
    <!--begin::Menu Nav-->
    <ul class="menu-nav ">
      <li class="menu-item @if ($moduloActual === false) menu-item-active @endif" aria-haspopup="true">
        <a href="/home" class="menu-link">
          <span class="menu-icon icon-md fas fa-dice-d6"></span>
          <span class="menu-text">Inicio</span>
        </a>
      </li>
      <li class="menu-section">
        <h4 class="menu-text">Módulos</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
      </li>
      @foreach (obtenerModulosActivos() as $key => $value)
        @php
          $estoyAqui = $moduloActual !== false && $value->get('alias') === $moduloActual->get('alias');
        @endphp
        <li class="menu-item menu-item-submenu @if($estoyAqui) menu-item-open menu-item-active @endif" aria-haspopup="true" data-menu-toggle="hover">
          <a href="{{ $value->get('contenido') ? 'javascript:;' : '/' . $value->get('alias') }}" class="menu-link menu-toggle">
            <span class="menu-icon icon-md {{ is_null($value->get('icono')) ? 'fab fa-ioxhost' : $value->get('icono') }}"></span>
            <span class="menu-text">{{ $value->get('titulo') ? $value->get('titulo') : $value->get('name') }}</span>
            @if ( $value->get('contenido') )
              <i class="menu-arrow"></i>
            @endif
          </a>
          @if ( $value->get('contenido') )
            <div class="menu-submenu">
              <i class="menu-arrow"></i>
              <ul class="menu-subnav">
                @foreach ($value->get('contenido') as $key => $value)
                  <li class="menu-item @if ($value["enlace"] === $_SERVER['REQUEST_URI']) menu-item-active @endif" aria-haspopup="true">
                    <a href="{{ $value['enlace'] }}" class="menu-link ">
                      <i class="menu-icon icon-nm {{ array_key_exists('icono', $value) ? $value['icono'] : 'fas fa-wave-square' }}" style="margin-top: 1.5px;"></i>
                      <span class="menu-text">{{ $key }}</span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        </li>
      @endforeach
    </ul>
    <!--end::Menu Nav-->
  </div>
  <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
