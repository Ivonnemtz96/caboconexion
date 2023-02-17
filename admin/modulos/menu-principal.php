<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="/admin"> <img alt="LOGO" src="/images/logo.png" class="header-logo" /></a>
            </div>
            <div class="sidebar-user">
                <div class="sidebar-user-picture">
                    <img alt="foto-perfil" src="<?php echo $fPerfil; ?>">
                </div>
                <div class="sidebar-user-details">
                    <div class="user-name"><?php echo ($UserData['nombre']);?></div>
                    <div class="user-role"><?php echo $rol; ?></div>
                    
                </div>
            </div>
          
            <ul class="sidebar-menu">
            <li class="menu-header">Panel de control</li>
            <li class="dropdown"><a href="/admin" class="nav-link"><i data-feather="monitor"></i><span>Resumen</span></a></li>
            <li class="dropdown"><a href="/admin/usuarios" class="nav-link"><i data-feather="users"></i><span>Usuarios</span></a></li>
            
            <li class="menu-header active">Empresas</li>
            <li class="dropdown"><a href="/admin/empresas" class="nav-link"><i data-feather="layers"></i><span>Todas las empresas</span></a></li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="corner-right-down"></i><span>Más</span></a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/nuevo/categoria-empresas">Categorías</a></li>
                    <li><a href="/admin/nuevo/subcategoria-empresas">SubCategorías</a></li>
                </ul>
            </li>
            <li class="menu-header active">Servicios</li>
            <li class="dropdown"><a href="/admin/servicios" class="nav-link"><i data-feather="layers"></i><span>Todos los servicios</span></a></li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="corner-right-down"></i><span>Más</span></a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/nuevo/categoria-servicios">Categorías</a></li>
                    <li><a href="/admin/nuevo/subcategoria-servicios">SubCategorías</a></li>
                </ul>
            </li>
            <li class="menu-header active">Productos</li>
            <li class="dropdown"><a href="/admin/productos" class="nav-link"><i data-feather="layers"></i><span>Todos los productos</span></a></li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="corner-right-down"></i><span>Más</span></a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/nuevo/categoria-productos">Categorías</a></li>
                    <li><a href="/admin/nuevo/subcategoria-productos">SubCategorías</a></li>
                </ul>
            </li>
            <li class="menu-header active">Configuracion</li>
            <li class="dropdown"><a href="/admin/msg-estado" class="nav-link"><i data-feather="alert-octagon"></i><span>Mensajes de status</span></a></li>
            <li class="dropdown"><a target="_blank" href="/" class="nav-link"><i data-feather="globe"></i><span>Ver sitio</span></a></li>
            
          </ul>
        </aside>
    </div>