  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="@if($page == 'dashboard') {{ 'active' }} @endif">
          <a href="/Dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
        </li>
@if(session('accType') == 'Super Admin' || session('accType') == 'Fleet Officer')
  <li class="@if($page == 'organization') {{ 'active' }} @endif"><a href="/Organization"><i class="fa fa-users"></i>Organizations</a></li>
@endif
@if(session('accType') == 'Super Admin')        
        <li class="treeview 
                            @if($page == 'fuel request' ||
                                $page == 'maintenance request' ||
                                $page == 'storekeeper request' ||
                                $page == 'fleet officer request' ||
                                $page == 'admin request' ||
                                $page == 'finance request'
                                ) {{ 'active' }}
                            @endif">
          <a href="#">
            <i class="fa fa-list"></i> <span>Request</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
@endif
@if(session('accType') == 'Super Admin' || session('accType') == 'Finance Department') 
            <li class="@if($page == 'fuel request') {{ 'active' }} @endif"><a href="/fuel request"><i class="fa fa-car"></i>Fuel Fund</a></li>
            <li class="@if($page == 'maintenance request') {{ 'active' }} @endif"><a href="/maintenance request"><i class="fa fa-cogs"></i>Maintenance</a></li>
            <li class="@if($page == 'storekeeper request') {{ 'active' }} @endif"><a href="/storekeeper request"><i class="fa fa-home"></i>Warehouse</a></li>
            <li class="@if($page == 'fleet officer request') {{ 'active' }} @endif"><a href="#"><i class="fa fa-user"></i>Fleet Officer</a></li>
            <li class="@if($page == 'admin request') {{ 'active' }} @endif"><a href="/admin request"><i class="fa fa-users"></i>Admin</a></li>
            <li class="@if($page == 'finance request') {{ 'active' }} @endif"><a href="/finance request"><i class="fa fa-money"></i>Finance Request</a></li>
@endif
@if(session('accType') == 'Super Admin')
          </ul>
        </li>
        <li class="@if($page == 'admin') {{ 'active' }} @endif">
        <a href="/admin"><i class="fa fa-home"></i>Admin Department</a>
        </li>
        <li class="@if($page == 'fleet Officer') {{ 'active' }} @endif">
        <a href="/fleet Officer"><i class="fa fa-users"></i>Fleet Officers</a>
        </li>
        <li class="@if($page == 'filling station') {{ 'active' }} @endif">
        <a href="/filling station"><i class="fa fa-home"></i>Filling Stations</a>
        </li>
        <li class="@if($page == 'fuel department') {{ 'active' }} @endif">
        <a href="/fuel department"><i class="fa fa-users"></i>Fuel Department</a>
        </li>
        
        <li class="@if($page == 'maintenance department') {{ 'active' }} @endif">
        <a href="/maintenance department"><i class="fa fa-cogs"></i>Maintenance Department</a>
        </li>
        <li class="@if($page == 'finance') {{ 'active' }} @endif">
        <a href="/finance"><i class="fa fa-money"></i>Finance Department</a>
        </li>
        <li class="@if($page == 'storekeeper') {{ 'active' }} @endif">
        <a href="/storekeeper"><i class="fa fa-home"></i>Storekeeper</a>
        </li>
        <li class="@if($page == 'vehicle') {{ 'active' }} @endif">
        <a href="/vehicle"><i class="fa fa-car"></i>Vehicle</a>
        </li>
        <li class="@if($page == 'warehouse') {{ 'active' }} @endif">
        <a href="/warehouse"><i class="fa fa-home"></i>Warehouse</a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            {{-- <li><a href="#"><i class="fa fa-plus-circle"></i> Create User</a></li> --}}
            <li><a href="#"><i class="fa fa-gear"></i> Manage Super Admin</a></li>
          </ul>
        </li>
@endif

@if(session('accType') == 'Fuel Department')

        <li class="@if($page == 'fuel data') {{ 'active' }} @endif">
        <a href="/fuel data"><i class="fa fa-car"></i>Fuel Data Entry</a>
        </li>

        <li class="@if($page == 'fuel request') {{ 'active' }} @endif">
        <a href="/fuel request"><i class="fa fa-car"></i>Fuel Fund Request</a>
        </li>
@endif
@if(session('accType') == 'Maintenance Department')

        <li class="@if($page == 'maintenance request') {{ 'active' }} @endif">
        <a href="/maintenance request"><i class="fa fa-cogs"></i>Vehicle Maintenance Request</a>
        </li>
@endif
@if(session('accType') == 'Admin Department')
        <li class="@if($page == 'admin request') {{ 'active' }} @endif">
        <a href="/admin request"><i class="fa fa-cogs"></i>Request</a>
        </li>
@endif
@if(session('accType') == 'Finance Department')
        <li class="@if($page == 'request') {{ 'active' }} @endif">
        <a href="/request"><i class="fa fa-cogs"></i>Request</a>
        </li>
@endif
@if(session('accType') == 'Storekeeper')
        <li class="@if($page == 'warehouse') {{ 'active' }} @endif">
        <a href="/warehouse"><i class="fa fa-cogs"></i>Products</a>
        </li>
        <li class="@if($page == 'storekeeper request') {{ 'active' }} @endif">
        <a href="/storekeeper request"><i class="fa fa-list"></i>Request</a>
        </li>
@endif
       
      </ul>
       
    </section>
    <!-- /.sidebar -->
  </aside>