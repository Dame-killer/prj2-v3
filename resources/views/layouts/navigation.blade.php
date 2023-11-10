<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            Trang chủ
        </a>
    </li>

    <li class="nav-item" aria-expanded="false">
        <a class="nav-link" href="{{ route('aa-point-class') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            Quản lý điểm
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('aa-student') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            Quản lý sinh viên
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('aa-classes-subjects') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            Quản lý lớp môn học
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('aa-major') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            Quản lý chuyên ngành
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('aa-class') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            Quản lý lớp
        </a>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Quản lý môn
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('aa-subject-BTEC') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    BTEC
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('aa-subject-BK') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    CĐN Bách Khoa
                </a>
            </li>
        </ul>
    </li>
</ul>
