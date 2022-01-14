<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="50" src="{{ asset('img/logo_trans.png')}}" class="header-brand-img" title="Bankalqita"> 
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('لوحة التحكم')}}</span></a>
                </div>
                <div class="nav-lavel">{{ __('اداراة النظام')}} </div>
                <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permission' ||$segment1 == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('المسؤول')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_user')
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('المستخدمين')}}</a>
                        <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('إنشاء مستخدم')}}</a>
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        @can('manage_roles')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('الأدوار')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('manage_permission')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('الأذونات')}}</a>
                        @endcan
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'categories') ? 'active' : '' }}">
                    <a href="{{url('categories')}}"><i class="ik ik-list"></i><span>{{ __('الفئات')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'products') ? 'active' : '' }}">
                    <a href="{{url('products')}}"><i class="ik ik-headphones"></i><span>{{ __('المنتجات')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'emirates' || $segment1 == 'cities') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-map-pin"></i><span>{{ __('المواقع')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('emirates')}}" class="menu-item {{ ($segment1 == 'emirates') ? 'active' : '' }}">{{ __('الامارات')}}</a>
                        <a href="{{url('cities')}}" class="menu-item {{ ($segment1 == 'cities') ? 'active' : '' }}">{{ __('المدن')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'stores') ? 'active' : '' }}">
                    <a href="{{url('stores')}}"><i class="ik ik-shopping-cart"></i><span>{{ __('المحلات')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'orders') ? 'active' : '' }}">
                    <a href="{{url('orders')}}"><i class="ik ik-shopping-cart"></i><span>{{ __('الطلبات')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'settings') ? 'active' : '' }}">
                    <a href="{{url('settings')}}"><i class="ik ik-settings"></i><span>{{ __('الأعدادات')}}</span></a>
                </div>

        </div>
    </div>
</div>