<!--- Side-navigation --->
<div class="l-navbar" id="nav-bar">
    <nav class="nav">

        <!--- For the side-navigation links --->
        <div class="side-nav">
            <a href="#" class="nav_logo">
                <img src="{{ asset('assets/images/WIF.ico') }}" class="nav_icon" style="width:28px; height:28px" />
                <span class="nav_logo-name">WHR</span>
            </a>

            <!--- For the dashboard link --->
            <div class="nav_list side_nav-list nav-dashboard">
                <a href="{{ url('Mainpage/dashboard') }}" class="nav_link">
                    <i class='bi bi-grid-1x2-fill nav_icon'></i>
                    <span class="nav_name">Dashboard</span>
                </a>
            </div><!--- Closing of nav_list side_nav-list nav-dashboard --->

            <!--- For the Users link --->
            <div class="nav_list side_nav-list nav-users">
                <a href="{{ url('Mainpage/users') }}" class="nav_link">
                    <i class='bi bi-people-fill nav_icon'></i>
                    <span class="nav_name">Users</span>
                </a>
            </div><!--- Closing of nav_list side_nav-list nav-users --->
        </div><!--- Closing of side-nav --->


    </nav>
</div><!--- Closing of l-navbar --->