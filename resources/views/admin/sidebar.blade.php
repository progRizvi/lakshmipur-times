<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"><img class="w-75" src="{{ asset($setting->logo) ?? '' }}"
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset($setting->favicon) ?? '' }}"
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <ul class="sidebar-menu">
            @adminCan('dashboard.view')
                <li class="{{ isRoute('admin.dashboard', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endadminCan
            @adminCan(['state.view', 'city.view'])
                <li
                    class="nav-item dropdown {{ Route::is('admin.country.*') || Route::is('admin.state.*') | Route::is('admin.city.*') || Route::is('admin.deliveryArea.*') ? 'active' : '' }}">
                    <a href="javascript:;" class="nav-link has-dropdown"><i
                            class="fas fa-map-marker-alt"></i><span>{{ __('Location') }}</span></a>
                    <ul class="dropdown-menu">
                        @adminCan('state.view')
                            <li class="{{ Route::is('admin.state*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.state.index') }}">{{ __('State') }}</a>
                            </li>
                        @endadminCan
                        @adminCan('city.view')
                            <li class="{{ Route::is('admin.city*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.city.index') }}">{{ __('City') }}</a>
                            </li>
                        @endadminCan
                    </ul>
                </li>
            @endadminCan

            @if (checkAdminHasPermission('blog.view') ||
                    checkAdminHasPermission('subscription.view') ||
                    checkAdminHasPermission('customer.view') ||
                    checkAdminHasPermission('team.management'))

                <li class="menu-header">{{ __('Manage Contents') }}</li>

                @if (Module::isEnabled('Blog') && checkAdminHasPermission('blog.view'))
                    @include('blog::sidebar')
                @endif

                @if (Module::isEnabled('OurTeam') && checkAdminHasPermission('team.management'))
                    @include('ourteam::sidebar')
                @endif

            @endif

            <li class="{{ isRoute('admin.video*', 'active') }}">
                <a class="nav-link" href="{{ route('admin.video.index') }}"><i class="fas fa-video fa-fw"></i>
                    <span>{{ __('Video') }}</span>
                </a>
            </li>

            @if (checkAdminHasPermission('menu.view') ||
                    checkAdminHasPermission('page.view') ||
                    checkAdminHasPermission('faq.view') ||
                    checkAdminHasPermission('social.link.management'))
                <li class="menu-header">{{ __('Manage Website') }}</li>

                @if (Module::isEnabled('CustomMenu') && checkAdminHasPermission('menu.view'))
                    @include('custommenu::sidebar')
                @endif

                @if (Module::isEnabled('PageBuilder') && checkAdminHasPermission('page.view'))
                    @include('pagebuilder::sidebar')
                @endif

                @if (Module::isEnabled('SocialLink') && checkAdminHasPermission('social.link.management'))
                    @include('sociallink::sidebar')
                @endif
            @endif

            @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('setting.view'))
                <li class="{{ isRoute('admin.settings', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                </li>
            @endif

            @if (Module::isEnabled('ContactMessage') && checkAdminHasPermission('contect.message.view'))
                @include('contactmessage::sidebar')
            @endif
        </ul>
    </aside>
</div>
