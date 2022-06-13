 <!-- ////////////////////////////////////////////////////////////////////////////-->
 <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('site.adminPanel')</span></a>
          <ul class="menu-content">
            <li class="{{Request::is('*/admin/home')?'active':''}}"><a class="menu-item" href="{{ route('admin.home') }}" data-i18n="nav.dash.ecommerce">@lang('site.homepage')</a>
            </li>
          </ul>
        </li>

        <!-- settings -->
        @if (get_permission('settings_read'))
        <li class="nav-item {{Request::is('*/settings/*')?'open':''}}"><a href="#"><i class="la la-cogs"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('site.settings') }}</span></a>
          <ul class="menu-content">
          @if (get_permission('settings_create'))
            <li class="{{Request::is('*/settings/general')?'active':''}}"><a class="menu-item" href="{{ route('admin.settings.general') }}">{{ __('site.general_settings') }}</a>
            </li>
            @endif
          </ul>
        </li>
        @endif

        <!-- admins -->
        @if (get_permission('admins_read'))
        <li class="nav-item {{Request::is('*/admins/*')?'open':''}}"><a href="#"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('site.admins') }}</span></a>
          <ul class="menu-content">
            <li class="{{Request::is('*/admins')?'active':''}}"><a class="menu-item" href="{{ route('admin.admins.index') }}">{{ __('site.show_admins') }}</a>
            </li>
            @if (get_permission('admins_create'))
            <li class="{{Request::is('*/admins/create')?'active':''}}"><a class="menu-item" href="{{ route('admin.admins.create') }}" data-i18n="nav.templates.vert.compact_menu">{{ __('site.add_admin') }}</a>
            </li>
            @endif

          </ul>
        </li>
        @endif

        {{--roles--}}
        @if (get_permission('roles_read'))
        <li class="nav-item {{Request::is('*/roles/*')?'open':''}}"><a href="#"><i class="la la-sitemap"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('site.roles') }}</span></a>
          <ul class="menu-content">
            <li class="{{Request::is('*/roles')?'active':''}}"><a class="menu-item" href="{{ route('admin.roles.index') }}">{{ __('site.show_roles') }}</a>
            </li>
            @if (get_permission('roles_create'))
            <li class="{{Request::is('*/roles/create')?'active':''}}"><a class="menu-item" href="{{ route('admin.roles.create') }}" data-i18n="nav.templates.vert.compact_menu">{{ __('site.add_roles') }}</a>
            </li>
            @endif

          </ul>
        </li>
        @endif

        <!-- users -->
        @if (get_permission('users_read'))
        <li class="nav-item {{Request::is('*/users/*')?'open':''}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('site.users') }}</span></a>
        <ul class="menu-content">
            <li class="{{Request::is('*/users')?'active':''}}"><a class="menu-item" href="{{ route('admin.users.index') }}">{{ __('site.show_users') }}</a>
            </li>
            @if (get_permission('users_create'))
            <li class="{{Request::is('*/users/create')?'active':''}}"><a class="menu-item" href="{{ route('admin.users.create') }}" data-i18n="nav.templates.vert.compact_menu">{{ __('site.add_user') }}</a>
            </li>
            @endif
        </ul>
        </li>
        @endif

          </ul>
        </li>
      </ul>
    </div>
  </div>
