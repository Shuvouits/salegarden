<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini" style="font-size: 15px;"><b>Ecomm</b></span>
        <span class="logo-lg" style="font-size: 18px;"><b>Admin Portal</b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="user user-menu">
                    <a href="{{ URL::to('portal/profile') }}">
                        <span>Welcome, {{ Auth::user()->users_name }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
