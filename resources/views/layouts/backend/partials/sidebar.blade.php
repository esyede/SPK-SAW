<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li>
                    <a href="/dashboard" class="{{ Request::is('dashboard*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>

                @can('roles.index')
                <li>
                    <a href="/roles" class="{{ Request::is('roles*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-check"></i>
                        Roles
                    </a>
                </li>
                @endcan

                @can('evaluation.index')
                <li class="app-sidebar__heading">SPK</li>
                @endcan

                @can('criteria.index')
                <li>
                    <a href="/criteria" class="{{ Request::is('criteria*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-news-paper"></i>
                        Kriteria
                    </a>
                </li>
                @endcan

                @can('sub-criteria.index')
                <li>
                    <a href="/sub-criteria" class="{{ Request::is('sub-criteria*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Sub Kriteria
                    </a>
                </li>
                @endcan

                @can('integrity.index')
                <li>
                    <a href="/integrity" class="{{ Request::is('integrity*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-graph3"></i>
                        Pembobotan Nilai
                    </a>
                </li>
                @endcan

                @can('users.index')
                <li>
                    <a href="/users" class="{{ Request::is('users*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Pegawai
                    </a>
                </li>
                @endcan

                @can('evaluation.index')
                <li>
                    <a href="{{ (Auth::user()->role_id == 2) ? url('/evaluation/detail', Auth::id()) : '/evaluation' }}" class="{{ Request::is('evaluation*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-note"></i>
                        Penilaian
                    </a>
                </li>
                @endcan

                @can('settings.index')
                <li class="app-sidebar__heading">Pengaturan</li>
                @endcan

                @can('settings.index')
                <li>
                    <a href="/settings/general" class="{{ Request::is('setting/general*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-settings"></i>
                        Umum
                    </a>
                </li>
                @endcan

                @can('backups.index')
                <li>
                    <a href="/backups" class="{{ Request::is('backups*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-cloud"></i>
                        Backup
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
