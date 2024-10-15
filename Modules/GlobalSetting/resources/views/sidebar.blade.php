<li class="menu-header">Settings</li>
<li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}"><a class="nav-link"
        href="{{ route('admin.general-setting') }}"><i class="fas fa-cog"></i>
        <span>{{ __('General Settings') }}</span></a></li>


<li class="{{ Route::is('admin.seo-setting') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.seo-setting') }}"><i class="fas fa-search"></i>
        <span>{{ __('SEO Setup') }}</span>
    </a>
</li>

<li class="{{ Route::is('admin.cache-clear') ? 'active' : '' }}"><a class="nav-link"
        href="{{ route('admin.cache-clear') }}"><i class="fas fa-sync"></i>
        <span>{{ __('Clear cache') }}</span>
    </a></li>
