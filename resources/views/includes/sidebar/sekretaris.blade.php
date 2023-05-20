<ul class="menu">
    <li class="sidebar-title">Halo Sekretaris</li>
    <li class="sidebar-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard.index') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub {{ request()->is('sekretaris/reimbuse*') ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-file-earmark-fill"></i>
            <span>Reimburse</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('sekretaris.reimbuse.index') }}">Reimburse Pending</a>
            </li>
            {{-- <li class="submenu-item ">
                <a href="{{ route('sekretaris.reimbuse.index.transfer') }}">Reimburse Perlu Di Transfer</a>
            </li> --}}
        </ul>
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
