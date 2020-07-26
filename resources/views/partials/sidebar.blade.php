@php
    $routeName = request()->route()->getName();
@endphp

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ $routeName == 'index' ? 'active' : '' }}" href="{{ route('index') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $routeName == 'tradeflows' ? 'active' : '' }}" href="{{ route('tradeflows', ['filter'=> 'all']) }}">
                    <span data-feather="layers"></span>
                    Tradeflows
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $routeName == 'containers' ? 'active' : '' }}" href="{{ route('containers', ['filter'=> 'all']) }}">
                    <span data-feather="box"></span>
                    Containers
                </a>
            </li>
        </ul>
    </div>
</nav>
