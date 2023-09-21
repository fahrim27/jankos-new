<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/jankos-logo.png') }}" alt="" width="35" height="35">
                    <h2 class="brand-text mb-0">Jankos Event</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            @if (auth()->user()->hasRole('Super Admin'))
            <li class=" navigation-header"><span>DATA MASTER</span>
            </li>
            <li class=" nav-item {{ request()->is('users') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Pengguna</span></a>
            </li>
            <li class=" nav-item {{ request()->is('access-request') ? 'active' : '' }}"><a href="{{ route('access-request.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">Akses Request <span class="badge badge-warning badge-sm"> {{\DB::table('users')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->where(['role_id' => 3, 'status' => NULL])
                ->count()}}</span></span></a>
            </li>
            @endif
            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
            <li class=" nav-item {{ request()->is('all-teams') ? 'active' : '' }}"><a href="{{ route('all-teams.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">Team</span></a>
            </li>
            {{-- <li class=" nav-item {{ request()->is('sliders') ? 'active' : '' }}"><a href="{{ route('sliders.index') }}"><i class="feather icon-image"></i><span class="menu-title" data-i18n="User">Slider</span></a>
            </li>
            <li class=" nav-item {{ request()->is('video') ? 'active' : '' }}"><a href="{{ route('video.index') }}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="User">Video</span></a>
            </li> --}}
            @endif

            @if (auth()->user()->hasRole('Teacher'))
                <li class=" navigation-header"><span>EVENT</span>
                </li>

                <li class=" nav-item {{ request()->is('teams') ? 'active' : '' }}"><a href="{{ route('teams.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">Data Peserta</span></a></li>
                <li class=" nav-item {{ request()->is('documents') ? 'active' : '' }}"><a href="{{ route('documents.index') }}"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="User">Data presentasi</span></a></li>
                <li class=" nav-item {{ request()->is('videos') ? 'active' : '' }}"><a href="{{ route('videos.index') }}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="User">Data Video</span></a></li>
                <li class=" nav-item {{ request()->is('members') ? 'active' : '' }}"><a href="{{ route('members.index') }}"><i class="feather icon-user-check"></i><span class="menu-title" data-i18n="User">Data Member</span></a></li>
                <li class=" nav-item {{ request()->is('logbooks') ? 'active' : '' }}"><a href="{{ route('logbooks.index') }}"><i class="feather icon-clipboard"></i><span class="menu-title" data-i18n="User">Data Laporan Penjualan</span></a></li>
                <li class=" nav-item {{ request()->is('transfers') ? 'active' : '' }}"><a href="{{ route('transfers.index') }}"><i class="feather icon-tag"></i><span class="menu-title" data-i18n="User">Data Transfer</span></a></li>
                
            @endif
            
            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                <li class=" navigation-header"><span>EVENT</span>
                </li>

                <li class=" nav-item {{ request()->is('teams') ? 'active' : '' }}"><a href="{{ route('teams.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">Data Peserta</span></a></li>
                <li class=" nav-item {{ request()->is('documents') ? 'active' : '' }}"><a href="{{ route('documents.index') }}"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="User">Data presentasi</span></a></li>
                <li class=" nav-item {{ request()->is('videos') ? 'active' : '' }}"><a href="{{ route('videos.index') }}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="User">Data Video</span></a></li>
                <li class=" nav-item {{ request()->is('members') ? 'active' : '' }}"><a href="{{ route('members.index') }}"><i class="feather icon-user-check"></i><span class="menu-title" data-i18n="User">Data Member</span></a></li>
                <li class=" nav-item {{ request()->is('logbooks') ? 'active' : '' }}"><a href="{{ route('logbooks.index') }}"><i class="feather icon-clipboard"></i><span class="menu-title" data-i18n="User">Data Laporan Penjualan</span></a></li>
                <li class=" nav-item {{ request()->is('transfers') ? 'active' : '' }}"><a href="{{ route('transfers.index') }}"><i class="feather icon-tag"></i><span class="menu-title" data-i18n="User">Data Transfer</span></a></li>
                
                <li class=" nav-item {{ request()->is('photo-contest') ? 'active' : '' }}"><a href="{{ route('photo-contest.index') }}"><i class="feather icon-image"></i><span class="menu-title" data-i18n="User">Foto Kontes</span></a></li>
            @endif

           <!--  @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                <li class=" navigation-header"><span>BLOG</span>
                <li class=" nav-item {{ request()->is('articles') ? 'active' : '' }}"><a href="{{ route('articles.index') }}"><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Article">Artikel</span></a>
                </li>
            @endif -->

            <!--{{-- @if (auth()->user()->hasRole('HRD') || auth()->user()->hasRole('Jobseeker')) --}}-->
            <!--    <li class=" navigation-header"><span>Panduan</span>-->
            <!--    <li class=" nav-item {{ request()->is('guides') ? 'active' : '' }}"><a href="{{ route('guides.index') }}"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="Documentation">Buku Panduan</span></a>-->
            <!--    </li>-->
            <!--{{-- @endif --}}-->
        </ul>
    </div>
</div>
