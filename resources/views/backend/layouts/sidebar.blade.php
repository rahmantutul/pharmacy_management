<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
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
        <li class="{{ request()->routeIs('vendor.*') ? 'mm-active' : '' }}">
            <a href="{{route('vendor.index')}}">
                <div class="parent-icon"> <i class="fadeIn animated bx bx-unlink"></i>
                </div>
                <div class="menu-title">{{__('Vendor')}}</div>
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
                <li class="{{ request()->routeIs('type.*') ? 'mm-active' : '' }}"> <a href="{{route('type.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Type')}}</a>
                </li>
                <li class="{{ request()->routeIs('medicine.*') ? 'mm-active' : '' }}"> <a href="{{route('medicine.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('Medicine')}}</a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->routeIs('payment.*') ? 'mm-active' : '' }}">
            <a href="{{route('payment.index')}}">
                <div class="parent-icon"> <i class="fadeIn animated bx bx-windows"></i>
                </div>
                <div class="menu-title">{{__('Payment Method')}}</div>
            </a>
        </li>
        <li class="{{ request()->routeIs('purchase.*') ? 'mm-active' : '' }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='fadeIn animated bx bx-capsule'></i>
                </div>
                <div class="menu-title">{{__('Purchase')}}</div>
            </a>
            <ul>
                <li class="{{ request()->routeIs('purchase.create') ? 'mm-active' : '' }}"> <a href="{{route('purchase.create')}}"><i class="bx bx-right-arrow-alt"></i>{{__('New Purchase')}}</a>
                </li>
                <li class="{{ request()->routeIs('purchase.index') ? 'mm-active' : '' }}"> <a href="{{route('purchase.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('All Purchase')}}</a>
                </li>
                
            </ul>
        </li>
        <li class="{{ request()->routeIs('sales.*') ? 'mm-active' : '' }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='fadeIn animated bx bx-barcode'></i>
                </div>
                <div class="menu-title">{{__('Sales')}}</div>
            </a>
            <ul>
                <li class="{{ request()->routeIs('sales.create') ? 'mm-active' : '' }}"> <a href="{{route('sales.create')}}"><i class="bx bx-right-arrow-alt"></i>{{__('New Sales')}}</a>
                </li>
                {{-- <li class="{{ request()->routeIs('purchase.index') ? 'mm-active' : '' }}"> <a href="{{route('purchase.index')}}"><i class="bx bx-right-arrow-alt"></i>{{__('All Purchase')}}</a>
                </li> --}}
                
            </ul>
        </li>
        <li>
            <a href="{{route('cache.clear')}}">
                <div class="parent-icon"> <i class="fadeIn animated bx bx-health"></i>
                </div>
                <div class="menu-title">{{__('Clear Cache')}}</div>
            </a>
        </li>
    </ul>

    <!--end navigation-->
</div>
<!--end sidebar wrapper -->