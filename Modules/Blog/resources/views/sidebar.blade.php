@if (Module::isEnabled('Blog') && Route::has('admin.news.index'))
    <li
        class="nav-item dropdown {{ isRoute(['admin.news.*', 'admin.news-category.*', 'admin.news-comment.*'], 'active') }}">
        <a href="javascript:void()" class="nav-link has-dropdown"><i
                class="fas fa-newspaper"></i><span>{{ __('Manage News') }}</span></a>

        <ul class="dropdown-menu">
            @adminCan('blog.category.view')
                <li class="{{ isRoute('admin.news-category.*', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.news-category.index') }}">
                        {{ __('Category List') }}
                    </a>
                </li>
            @endadminCan
            @adminCan('blog.view')
                <li class="{{ isRoute('admin.news.*', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.news.index') }}">
                        {{ __('News List') }}
                    </a>
                </li>
            @endadminCan
            @adminCan('blog.comment.view')
                <li class="{{ isRoute('admin.news-comment.*', 'active') }}">
                    <a class="nav-link" href="{{ route('admin.news-comment.index') }}">
                        {{ __('News Comments') }}
                    </a>
                </li>
            @endadminCan
        </ul>
    </li>
@endif
