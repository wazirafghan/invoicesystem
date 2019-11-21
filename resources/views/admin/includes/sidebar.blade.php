<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
        </div>
        <?php $user = Auth::user(); ?>
        <ul class="nav" id="side-menu">
            <li> <a href="{{route('admin.dashboard')}}" class="waves-effect"><i class="fa fa-dashboard fa-fw"></i><span class="hide-menu"> Dashboard </span></a> </li>
            <li> <a href="{{route('users.index')}}" class="waves-effect"><i class="fa fa-users fa-fw"></i><span class="hide-menu"> Manage Users </span></a> </li>
            <li> <a href="{{route('staff.index')}}" class="waves-effect"><i class="fa fa-user-secret fa-fw"></i><span class="hide-menu"> Manage Staff </span></a> </li>
            <li> <a href="{{route('settings.index')}}" class="waves-effect"><i class="ti-settings fa-fw"></i><span class="hide-menu"> Settings</span></a> </li>
        </ul>
    </div>
</div>

