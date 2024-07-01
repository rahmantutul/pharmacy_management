<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ __('Pharmacy') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="{{ request()->routeIs('home') ? 'mm-active' : '' }}">
            <a href="{{route('home')}}">
                <div class="parent-icon"> <i class="bx bx-video-recording"></i>
                </div>
                <div class="menu-title">{{__('Dashboard')}}</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-command' ></i>
                </div>
                <div class="menu-title">{{__('System Info')}}</div>
            </a>
            <ul>
                @if(auth()->user()->can('user-list'))
                <li class="{{ request()->routeIs('users.*') ? 'mm-active' : '' }}"> <a href="{{route('users.index')}}" ><i class="bx bx-right-arrow-alt"></i>{{__('Users')}}</a>
                </li>
                @endif
                @if(auth()->user()->can('role-access'))
                <li class="{{ request()->routeIs('role.*') ? 'mm-active' : '' }}"> <a href="{{route('role.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Roles')}}</a>
                </li>
                @endif
                @if(auth()->user()->can('permission-access'))
                <li class="{{ request()->routeIs('permission.*') ? 'mm-active' : '' }}"> <a href="{{route('permission.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Permission')}}</a>
                </li>
                @endif
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='fadeIn animated bx bx-cog' ></i>
                </div>
                <div class="menu-title">{{__('Settings')}}</div>
            </a>
            <ul>
                @if(auth()->user()->can('settings'))
                <li class="{{ request()->routeIs('gsetting.*') ? 'mm-active' : '' }}"> <a href="{{route('gsetting.index')}}" ><i class="bx bx-right-arrow-alt"></i>{{__('General Setting')}}</a>
                </li>
                <li class="{{ request()->routeIs('esetting.*') ? 'mm-active' : '' }}"> <a href="{{route('esetting.index')}}" ><i class="bx bx-right-arrow-alt"></i>{{__('Email Setting')}}</a>
                </li>
                @endif
            </ul>
        </li>
        <li class="{{ request()->routeIs('customer.*') ? 'mm-active' : '' }}">
            <a href="{{route('customer.index')}}">
                <div class="parent-icon"> <i class="fadeIn animated bx bx-body"></i>
                </div>
                <div class="menu-title">{{__('Customers')}}</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-spa'></i>
                </div>
                <div class="menu-title">Expense</div>
            </a>
            <ul>
                <li class="{{ request()->routeIs('ecategory.*') ? 'mm-active' : '' }}"> <a href="{{route('ecategory.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Expense Category')}}</a>
                </li>
                <li {{ request()->routeIs('expense.*') ? 'mm-active' : '' }}"> <a href="{{route('expense.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Expense')}}</a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->routeIs('supplier.*') ? 'mm-active' : '' }}">
            <a href="{{route('supplier.index')}}">
                <div class="parent-icon"> <i class="fadeIn animated bx bx-network-chart"></i>
                </div>
                <div class="menu-title">{{__('Supplier')}}</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='fadeIn animated bx bx-capsule'></i>
                </div>
                <div class="menu-title">{{__('Medicine')}}</div>
            </a>
            <ul>
                <li class="{{ request()->routeIs('category.*') ? 'mm-active' : '' }}"> <a href="{{route('category.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Category')}}</a>
                </li>
                <li class="{{ request()->routeIs('unit.*') ? 'mm-active' : '' }}"> <a href="{{route('unit.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Unit')}}</a>
                </li>
                <li class="{{ request()->routeIs('leaf.*') ? 'mm-active' : '' }}"> <a href="{{route('leaf.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Leaf')}}</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->