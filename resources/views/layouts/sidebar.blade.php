<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset("admin_lte_3.2.0/dist/img/AdminLTELogo.png") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TIME TRACKING</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('home-index')
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home*') ? "active":'' }}">
                            <i class="fa fa-home"></i>
                            <p>Главная</p>
                        </a>
                    </li>
                @endcan

                @can('tt-index')
                    <li class="nav-item">
                        <a href="{{ route('tt.index') }}" class="nav-link {{ Request::is('tt*') ? "active":'' }}">
                            <i class="fa fa-sim-card"></i>
                            <p>Учет времени</p>
                        </a>
                    </li>
                @endcan

                @can('cadre-index')
                    <li class="nav-item">
                        <a href="{{ route("cadre.index") }}" class="nav-link {{ Request::is('cadre*') ? "active":'' }}">
                            <i class="fa fa-person-booth"></i>
                            <p>Кадр</p>
                        </a>
                    </li>
                @endcan

                @canany(['holiday-index','bugalter-index'])
                    <li class="nav-item {{ (Request::is('holiday*') or Request::is('bugalter*')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (Request::is('holiday*') or Request::is('bugalter*')) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Бугалтер
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('bugalter-index')
                                <li class="nav-item">
                                    <a href="{{ route('bugalter.index') }}" class="nav-link {{ Request::is('bugalter*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Бугалтер</p>
                                    </a>
                                </li>
                            @endcan

                            @can('holiday-index')
                                <li class="nav-item">
                                    <a href="{{ route('holiday.index') }}" class="nav-link {{ Request::is('holiday*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Информация</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @can('employee-index')
                    <li class="nav-item">
                        <a href="{{ route('employee.index') }}" class="nav-link {{ Request::is('employee*') ? "active":'' }}">
                            <i class="fa fa-users"></i>
                            <p>Сотрудник</p>
                        </a>
                    </li>
                @endcan

                @can('change-hours-index')
                    <li class="nav-item">
                        <a href="{{ route('change_hours.index') }}" class="nav-link {{ Request::is('change-hours*') ? "active":'' }}">
                            <i class="fa fa-users"></i>
                            <p>Изменение рабочего времени</p>
                        </a>
                    </li>
                @endcan

                @can('department-index')
                    <li class="nav-item">
                        <a href="{{ route('department.index') }}" class="nav-link {{ Request::is('department*') ? "active":'' }}">
                            <i class="fa fa-directions"></i>
                            <p>Отделы</p>
                        </a>
                    </li>
                @endcan

                @can('position-index')
                    <li class="nav-item">
                        <a href="{{ route('position.index') }}" class="nav-link {{ Request::is('position*') ? "active":'' }}">
                            <i class="fa fa-poo-storm"></i>
                            <p>Должность</p>
                        </a>
                    </li>
                @endcan


                @canany(['role-index','user-index'])
                    <li class="nav-item {{ (Request::is('roles*') or Request::is('permissions*') or Request::is('user*')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (Request::is('roles*') or Request::is('permissions*') or Request::is('user*')) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Управление
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user-index')
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Пользователями</p>
                                    </a>
                                </li>
                            @endcan

                            @can('role-index')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Роли</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
