{{-- @php
    dd($permissions);
@endphp --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ $company_name }} Administrator<sup></sup></div>
    </a>
    <!-- Divider -->

     {{-- @if($permission_item) === 1)
        I have one record!
        @elseif (count($records) > 1)
        I have multiple records!
        @else
        I don't have any records!
        @endif --}}
    @foreach ($permissions as $permission_item)
        @if(count($permission_item['childs']) > 0)
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            {{ $permission_item['name'] }}
        </div>
        @foreach ($permission_item['childs'] as $key_childs => $item_childs)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin',$item_childs->module_type) }}" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="{{ $item_childs->imagen }}"></i>
                    <span>{{ $item_childs->name }}</span>
                </a>
            </li>
        @endforeach
        @else
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin',$permission_item['module_type']) }}">
                    <i class="{{ $permission_item['image'] }}"></i>
                    <span>{{ $permission_item['name'] }}</span>
                </a>
            </li>
        @endif
        
    @endforeach

    {{-- <!-- Heading -->
    <div class="sidebar-heading">
        Administración
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.users') }}" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="user_icon icons-fa"></i>
            <span>Usuarios</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Información
    </div>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.driver_info') }}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="drivers_info_icon icons-fa"></i>
            <span>Informacion Conductores</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.driving_licence') }}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="licence_icon icons-fa"></i>
            <span>Licencia</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.vehicle') }}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="car_icon icons-fa"></i>
            <span>Vehículo</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('images.index')}}" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="img_icon icons-fa"></i>
            <span>Imágenes</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider"> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>