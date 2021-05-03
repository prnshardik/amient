<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('assets/img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->name }}</div>
                <small>
                    @if(auth()->user()->is_admin == 'y')
                        Administrator 
                    @else
                        User
                    @endif
                </small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                <a class="{{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('users*') ? 'active' : '' }}">
                <a class="{{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users') }}"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Users</span>
                </a>
            </li>
            <li class="{{ Request::is('products*') ? 'active' : '' }}">
                <a class="{{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products') }}"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                    <span class="nav-label">Products</span>
                </a>
            </li>
            <li class="{{ Request::is('task*') ? 'active' : '' }}">
                <a class="{{ Request::is('task*') ? 'active' : '' }}" href="{{ route('task') }}"><i class="sidebar-item-icon fa fa-tasks"></i>
                    <span class="nav-label">Tasks</span>
                </a>
            </li>
            <li class="{{ Request::is('notices*') ? 'active' : '' }}">
                <a class="{{ Request::is('notices*') ? 'active' : '' }}" href="{{ route('notices') }}"><i class="sidebar-item-icon fa fa-bullhorn"></i>
                    <span class="nav-label">Notices</span>
                </a>
            </li>
        </ul>
    </div>
</nav>