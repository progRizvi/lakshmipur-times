@if (Module::isEnabled('CustomMenu') && Route::has('admin.custom-pages.index'))
    <li class="{{ Route::is('admin.custom-pages.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.custom-pages.index') }}">
            <i class="fas fa-pager"></i> <span>{{ __('Customizeable Page') }}</span>
        </a>
    </li>
@endif
