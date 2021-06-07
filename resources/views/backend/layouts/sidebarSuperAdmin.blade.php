<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">&nbsp;</li>
            <li class="treeview" id="menu1">
                @if(Auth::user()->users_type == 'Super Admin')
                <a href="{{ URL::to('portal/dashboard') }}">
                    <i class="fa fa-home"></i><span>Dashboard</span>
                </a>
                @elseif(Auth::user()->users_type == 'Company')
                <a href="{{ URL::to('portal/dashboard/company') }}">
                    <i class="fa fa-home"></i><span>Dashboard</span>
                </a>
                @elseif(Auth::user()->users_type == 'User')
                <a href="{{ URL::to('portal/dashboard/user') }}">
                    <i class="fa fa-home"></i><span>Dashboard</span>
                </a>
                @elseif(Auth::user()->users_type == 'Admin')
                <a href="{{ URL::to('portal/dashboard/admin') }}">
                    <i class="fa fa-home"></i><span>Dashboard</span>
                </a>
                @else
                @endif
            </li>
            <li class="treeview" id="menu2">
                <a href="{{ URL::to('portal/profile') }}">
                    <i class="fa fa-user"></i><span>Profile Settings</span>
                </a>
            </li>
            @if(Auth::user()->users_type == 'Super Admin')
            <li class="treeview" id="menu3">
                <a href="{{ URL::to('portal/admin/list') }}">
                    <i class="fa fa-renren"></i><span>Admin Settings</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->users_type == 'Super Admin' || Auth::user()->users_type == 'Admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>General Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="menu4"><a href="{{ URL::to('portal/category/list') }}"><i class="fa fa-circle-o"></i> Category</a></li>
                    <li id="menu5"><a href="{{ URL::to('portal/subCategory/list') }}"><i class="fa fa-circle-o"></i> Subcategory</a></li>
<!--                    <li id="menu6"><a href="{{ URL::to('portal/secondCategory/list') }}"><i class="fa fa-circle-o"></i> Second Category</a></li>  
                    -->
                    <li id="menu16"><a href="{{ URL::to('portal/brand/list') }}"><i class="fa fa-circle-o"></i> Brand</a></li>
                    <li id="menu5"><a href="{{ URL::to('portal/area/list') }}"><i class="fa fa-circle-o"></i> Area</a></li>
                </ul>
            </li>
            @endif  
            @if(Auth::user()->users_type == 'Super Admin' || Auth::user()->users_type == 'Admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-check"></i>
                    <span>Product Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="menu11"><a href="{{ URL::to('portal/product/activeList') }}"><i class="fa fa-circle-o"></i> Active Product</a></li>
                    <li id="menu12"><a href="{{ URL::to('portal/product/inactiveList') }}"><i class="fa fa-circle-o"></i> Inactive Product</a></li>                   
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-check"></i>
                    <span>Product Creation</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="menu7"><a href="{{ URL::to('portal/product/companyAdd') }}"><i class="fa fa-circle-o"></i> Add Product</a></li>
                    <li id="menu8"><a href="{{ URL::to('portal/product/companyList') }}"><i class="fa fa-circle-o"></i> View Product</a></li>  
                    <li id="menu14"><a href="{{ URL::to('portal/product/companyPreOrderList') }}"><i class="fa fa-circle-o"></i> View PreOrder Product</a></li>           
                    <li id="menu13"><a href="{{ URL::to('portal/product/preOrderAdd') }}"><i class="fa fa-circle-o"></i> Add PreOrder Product</a></li>                   
                </ul>
            </li>
            @endif 
            @if(Auth::user()->users_type == 'Company')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-check"></i>
                    <span>Product Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="menu7"><a href="{{ URL::to('portal/product/companyAdd') }}"><i class="fa fa-circle-o"></i> Add Product</a></li>
                    <li id="menu8"><a href="{{ URL::to('portal/product/companyList') }}"><i class="fa fa-circle-o"></i> View Product</a></li>  
                    <li id="menu14"><a href="{{ URL::to('portal/product/companyPreOrderList') }}"><i class="fa fa-circle-o"></i> View PreOrder Product</a></li>           
                    <li id="menu13"><a href="{{ URL::to('portal/product/preOrderAdd') }}"><i class="fa fa-circle-o"></i> Add PreOrder Product</a></li>                   
                </ul>
            </li>
            @endif 
            @if(Auth::user()->users_type == 'User')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-check"></i>
                    <span>Product Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="menu9"><a href="{{ URL::to('portal/product/userAdd') }}"><i class="fa fa-circle-o"></i> Add Product</a></li>
                    <li id="menu10"><a href="{{ URL::to('portal/product/userList') }}"><i class="fa fa-circle-o"></i> View Product</a></li>                   
                </ul>
            </li>
            @endif
            @if(Auth::user()->users_type == 'Company' || Auth::user()->users_type == 'User')
            <li class="treeview" id="menu15">
                <a href="{{ URL::to('portal/order/list') }}">
                    <i class="fa fa-cart-plus"></i><span>Order List</span>
                </a>
            </li>  
            @endif
            @if(Auth::user()->users_type == 'Super Admin')
            <li class="treeview" id="menu15">
                <a href="{{ URL::to('portal/contactList') }}">
                    <i class="fa fa-users"></i><span>Contact List</span>
                </a>
            </li>  
            @endif     
            <li class="treeview">
                <a href="{{ URL::to('logout') }}">
                    <i class="fa fa-sign-out"></i><span>Log Out</span>
                </a>
            </li>            
        </ul>
    </section>
</aside>
