<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
        data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">


            <li class="menu-item menu-item {{ (request()->is('home')) ? 'menu-item-active' : '' }} " aria-haspopup="true">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon flaticon-stopwatch"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>



            <li class="menu-item menu-item {{ (request()->is('forwarder')) ? 'menu-item-active' : '' }} " aria-haspopup="true">
                <a href="{{ route('forwarder') }}" class="menu-link">
                    <i class="menu-icon flaticon2-fast-next"></i>
                    <span class="menu-text">Forwarders</span>
                </a>
            </li>

            <li class="menu-item menu-item {{ (request()->is('successfull')) ? 'menu-item-active' : '' }} " aria-haspopup="true">
                <a href="{{ route('successfull') }}" class="menu-link">
                    <i class="menu-icon flaticon2-checkmark"></i>
                    <span class="menu-text">Successfull</span>
                </a>
            </li>

            <li class="menu-item menu-item {{ (request()->is('Profile')) ? 'menu-item-active' : '' }} " aria-haspopup="true">
                <a href="{{ route('profile') }}" class="menu-link">
                    <i class="menu-icon flaticon2-gear"></i>
                    <span class="menu-text">Settings</span>
                </a>
            </li>



            <li class="menu-item menu-item " aria-haspopup="true">
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                class="menu-link">
                    <i class="menu-icon flaticon-lock"></i>
                    <span class="menu-text">Log Out</span>

                </a>
            </li>

        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
</div>
<!--end::Aside-->
