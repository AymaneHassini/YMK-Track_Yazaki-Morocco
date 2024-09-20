<div class="left-side-menu">

<div class="h-100" data-simplebar>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul id="side-menu">

        <li class="menu-title">Navigation Menu</li>
<li>
    <a href="{{ route('dashboard') }}">
        <i class="mdi mdi-view-dashboard-outline"></i>
        <span> Dashboards </span>
    </a>
</li>
<li>
    {{-- <a href="{{ route('pos') }}"> --}}
    <a href="#">
        <i class="fa-solid fa-cash-register"></i>
        <span> Point Of Sale (POS) </span>
    </a>
    {{-- </a> --}}
</li>


            <li class="menu-title mt-2">App Features</li>
            {{-- @if(Auth::user()->can('employee.menu')) --}}

            <li>
                <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                <i class="bi bi-person-workspace"></i>

                    <span> Employee Manage </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('all.employee') }}">All Employee</a> 
                    </li>
                    <li>
                     <a href="{{ route('add.employee') }}">Add Employee </a> 
                    </li>
                        
                    </ul>
                </div>
            </li>
              {{--  @endif--}}

            {{-- @if(Auth::user()->can('customer.menu')) --}}

            <li>
                <a href="#sidebarCrm" data-bs-toggle="collapse">
                <i class="fa fa-users" aria-hidden="true"></i>

                    <span> Customer Manage </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCrm">
                    <ul class="nav-second-level">
                        {{-- @if(Auth::user()->can('customer.all')) --}}
                        <li>
                            <a href="{{ route('all.customer') }}">All Customer</a>
                        </li>
              {{--  @endif--}}
                        {{-- @if(Auth::user()->can('customer.add')) --}}
                        <li>
                           <a href="{{ route('add.customer') }}">Add Customer</a> 
                        </li>

              {{--  @endif--}}
                        
                    </ul>
                </div>
            </li>
              {{--  @endif--}}
              {{-- @if(Auth::user()->can('supplier.menu')) --}}

            <li>
                <a href="#sidebarEmail" data-bs-toggle="collapse">
                <i class="bi bi-truck-flatbed"></i>
                    <span> Supplier Manage </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="nav-second-level">
                       
                        <li>
                           <a href="{{route('all.supplier')}}">All Supplier</a> 
                        </li>
                        <li>
                             <a href="{{route('add.supplier')}}">Add Supplier</a> 
                        </li>
                      
                    </ul>
                </div>
            </li>
              {{--  @endif--}}
              {{--@if(Auth::user()->can('salary.menu')) --}}

            <li>
                <a href="#salary" data-bs-toggle="collapse">
                <i class="bi bi-cash-stack"></i>
                    <span> Employee Salary </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="salary">
                    <ul class="nav-second-level">
                       
                        <li>
                             <a href="{{route('all.advance.salary')}}">All Advance Salary</a> 
                        </li>
                        <li>
                             <a href="{{route('add.advance.salary')}}">Add Advance Salary </a> 
                        </li>
                        <li>
                             <a href="{{route('pay.salary')}}">Pay Salary</a> 
                        </li>
                        <li>
                             <a href="{{route('month.salary')}}">Last Month Salary</a> 
                        </li>
                      
                    </ul>
                </div>
            </li>
              {{--  @endif--}}
              {{--@if(Auth::user()->can('attendence.menu')) --}}

            <li>
                <a href="#attendance" data-bs-toggle="collapse">
                <i class="bi bi-calendar-check"></i>
                    <span> Employee Attendance </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="attendance">
                    <ul class="nav-second-level">
                       
                        <li>
                             <a href="{{route('employee.attend.list')}}">Employee Attendance List</a> 
                        </li>              
                    </ul>
                </div>
            </li>
              {{--  @endif--}}
             {{-- @if(Auth::user()->can('category.menu')) --}}

            <li>
                <a href="#category" data-bs-toggle="collapse">
                <i class="bi bi-collection"></i>
                    <span>Category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="category">
                    <ul class="nav-second-level">
                       
                        <li>
                            {{-- <a href="{{route('all.category')}}">All Category</a> --}}
                        </li>              
                    </ul>
                </div>
            </li>
              {{--  @endif--}}
              {{--@if(Auth::user()->can('product.menu')) --}}

            <li>
                <a href="#product" data-bs-toggle="collapse">
                <i class="bi bi-cart"></i>
                    <span>Products </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="product">
                    <ul class="nav-second-level">
                       
                        <li>
                            {{-- <a href="{{route('all.product')}}">All Products</a>
                            <a href="{{route('add.product')}}">Add Products</a> --}}

                        </li>   
                        <li>
                            {{-- <a href="{{route('import.product')}}">Import Products</a> --}}

                        </li>            
                    </ul>
                </div>
            </li>
              {{--  @endif--}}
             {{-- @if(Auth::user()->can('orders.menu')) --}} 

            <li>
                <a href="#orders" data-bs-toggle="collapse">
                <i class="bi bi-inbox"></i>
                    <span>Orders </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="orders">
                    <ul class="nav-second-level">
                       
                        <li>
                            {{-- <a href="{{route('pending.order')}}">Pending Orders</a> --}}
                            </li>   
                            <li>

                            {{-- <a href="{{route('complete.order')}}">Complete Orders</a> --}}

                        </li>   
                        <li>

                            {{-- <a href="{{route('pending.order')}}">Pending Due</a> --}}

                        </li>   
                   
                    </ul>
                </div>
            </li>
            {{-- @endif
            @if(Auth::user()->can('stock.menu')) --}}

            <li>
                <a href="#stock" data-bs-toggle="collapse">
                <i class="bi bi-boxes"></i><span>Stock Manage </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="stock">
                    <ul class="nav-second-level">
                       
                        <li>
                            {{-- <a href="{{route('stock.manage')}}">Pending Orders</a> --}}

                        </li>   
                   
                    </ul>
                </div>
            </li>
              {{--  @endif--}}

            <li>
                <a href="#permission" data-bs-toggle="collapse">
                <i class="bi bi-shield-lock"></i><span>Roles And Permissions </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="permission">
                    <ul class="nav-second-level">
                       
                        <li>
                            {{-- <a href="{{route('all.permission')}}">All Permissions</a> --}}

                        </li>   
                         
                        <li>
                            {{-- <a href="{{route('all.roles')}}">All Roles</a> --}}

                        </li>   
                        <li>
                            {{-- <a href="{{route('add.roles.permission')}}">Roles in Permissions</a> --}}

                        </li>   
                        <li>
                            {{-- <a href="{{route('all.roles.permission')}}">All Roles Permissions</a> --}}

                        </li>   
                   
                    </ul>
                </div>
            </li>
           

            <li>
                <a href="#admin" data-bs-toggle="collapse">
                <i class="bi bi-person-plus"></i><span>Setting Admin User</span>
                <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="admin">
                    <ul class="nav-second-level">
                       
                        <li>
                            {{-- <a href="{{route('all.admin')}}">All Admin</a> --}}

                        </li>   
                         
                        <li>
                            {{-- <a href="{{route('add.admin')}}">Add Admin</a> --}}

                        </li>   
         
                   
                    </ul>
                </div>
            </li>
            
            <li class="menu-title mt-2">Data Backup</li>
<li>
<a href="#backup" data-bs-toggle="collapse">
<i class="fas fa-database"></i>
<span>Database Backup</span>
<span class="menu-arrow"></span>
</a>

            <div class="collapse" id="backup">
<ul class="nav-second-level">
<li>
{{-- <a href="{{ route('database.backup') }}">Database Backup </a> --}}
</li> 

</ul>
</div>
</li>

        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>