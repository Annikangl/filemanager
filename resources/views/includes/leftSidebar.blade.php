<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        @if(auth()->user())
                            <span class="badge rounded-pill bg-success float-end">

                                {{ auth()->user()->uploads()->count() }}

                        </span>
                        @endif
                        <span>Мои файлы</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.upload-form') }}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Загрузить файл</span>
                    </a>
                </li>


                @if(auth()->user()->isAdmin())
                    <li class="menu-title">Управление</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-profile-line"></i>
                            <span>Пользователи</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('dashboard.users.create') }}" class="@if(Route::is('dashboard.user.create')) active @endif">Добавить пользователя</a></li>
                            <li><a href="{{ route('dashboard.users.index') }}" class="@if(Route::is('dashboard.user.index')) active @endif">Управление</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-profile-line"></i>
                            <span>Файлы</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('dashboard.uploads.index') }}" class="@if(Route::is('dashboard.uploads.index')) active @endif">Управление</a></li>
                        </ul>
                    </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
