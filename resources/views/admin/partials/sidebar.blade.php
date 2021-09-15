<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>

        @can('view-category')
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}"
               href="{{ route('admin.categories.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Categories</span>
            </a>
        </li>
        @endcan
        <li class="treeview"><a class="app-menu__item  {{ (Route::currentRouteName() == 'admin.users.change.password') ? 'active' : '' || Route::currentRouteName()== 'admin.users.detail' }} " href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Profile</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ route('admin.users.detail') }}"><i class="icon fa fa-passport"></i>Profile</a></li>
                <li><a class="treeview-item" href="{{ route('admin.users.change.password') }}"><i class="icon fa fa-passport"></i>Change Password</a></li>
            </ul>
        </li>
        @can('view-user')
            <li>
                <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.user.index') ? 'active' : '' }} "
                   href="{{ route('admin.user.index') }}">
                    <i class="app-menu__icon fa fa-tags"></i>
                    <span class="app-menu__label">User</span>
                </a>
            </li>
        @endcan

        @can('view-role')
            <li>
                <a class="app-menu__item {{ (Route::currentRouteName() == 'admin.roles.index') ? 'active' : '' }} "
                   href="{{ route('admin.roles.index') }}">
                    <i class="app-menu__icon fa fa-tags"></i>
                    <span class="app-menu__label">Role</span>
                </a>
            </li>
        @endcan
    </ul>
</aside>
