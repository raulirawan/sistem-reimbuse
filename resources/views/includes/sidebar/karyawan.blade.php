<ul class="menu">
    <li class="sidebar-title">Halo Karyawan</li>
    <li class="sidebar-item {{ request()->is('karyawan/dashboard*') ? 'active' : '' }}">
        <a href="{{ route('karyawan.dashboard.index') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->is('karyawan/reimbuse*') ? 'active' : '' }}">
        <a href="{{ route('karyawan.reimbuse.index') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Reimburse</span>
        </a>
    </li>

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
