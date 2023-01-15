<ul class="menu">
    <li class="sidebar-title">Halo Admin</li>
    <li class="sidebar-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard.index') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('admin/user*') ? 'active' : '' }}">
        <a href="{{ route('admin.user.index') }}" class='sidebar-link'>
            <i class="bi bi-people-fill"></i>
            <span>User</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('admin/jabatan*') ? 'active' : '' }}">
        <a href="{{ route('admin.jabatan.index') }}" class='sidebar-link'>
            <i class="bi bi-briefcase-fill"></i>
            <span>Jabatan</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('admin/reimbuse*') ? 'active' : '' }}">
        <a href="{{ route('admin.reimbuse.index') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Reimburse</span>
        </a>
    </li>
    {{-- <li class="sidebar-item has-sub {{ request()->is('admin/transaksi*') ? 'active' : '' }}">
    <a href="#" class='sidebar-link'>
        <i class="bi bi-file-earmark-fill"></i>
        <span>Transaksi</span>
    </a>
    <ul class="submenu">
        <li class="submenu-item ">
            <a href="{{ route('admin.transaksi.index') }}">List Transaksi</a>
        </li>
        <li class="submenu-item ">
            <a href="{{ route('admin.transaksi.check.in.index') }}">Check In</a>
        </li>
        <li class="submenu-item ">
            <a href="{{ route('admin.transaksi.check.out.index') }}">Check Out</a>
        </li>
    </ul>
</li> --}}
    <li class="sidebar-item">
        <a href="#" class='sidebar-link'
            onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-left"></i>
            <span>Logout</span>
        </a>
    </li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>



</ul>
