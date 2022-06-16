@can('ver-dashboard')
    <li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
        <a class="nav-link" href="/home">
            <i class=" fas fa-building"></i><span>Dashboard</span>
        </a>
    </li>
@endcan

@can('ver-usuario')
    <li class="side-menus {{ Request::is('users*') ? 'active' : '' }}">
        <a class="nav-link" href="/users">
            <i class=" fas fa-user-lock"></i><span>Usuarios</span>
        </a>
    </li>
@endcan
{{-- <li class="side-menus {{ Request::is('products*') ? 'active' : '' }}">
    <a class="nav-link" href="/products">
        <i class=" fas fa-users"></i><span>Productos</span>
    </a>
</li> --}}
<li class="nav-item dropdown {{ Request::is('fetch-documents*') || Request::is('*product*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>Productos</span></a>
    <ul class="dropdown-menu">
        <li class="{{ Request::is('fetch-products/1') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('products.fetch', 1) }}">Clase I</a></li>
        <li class="{{ Request::is('fetch-products/2') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('products.fetch', 2) }}">Clase II</a></li>
        <li class="{{ Request::is('fetch-products/3') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('products.fetch', 3) }}">Clase III</a></li>
    </ul>
</li>

@can('ver-rol')
    <li class="side-menus {{ Request::is('roles*') ? 'active' : '' }}">
        <a class="nav-link" href="/roles">
            <i class=" fas fa-lock"></i><span>Roles</span>
        </a>
    </li>
@endcan
