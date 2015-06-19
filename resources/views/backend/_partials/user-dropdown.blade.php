<!-- Menu Toggle Button -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <!-- The user image in the navbar-->
    <img src="/assets/vendor/admin-lte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
    <!-- hidden-xs hides the username on small devices so only the image appears. -->
    <span class="hidden-xs">{{ Auth::User()->name_first." ".Auth::User()->name_middle." ".Auth::User()->name_last }}</span>
</a>
<ul class="dropdown-menu">
    <!-- The user image in the menu -->
    <li class="user-header">
        <img src="/assets/vendor/admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
        <p>
            {{ Auth::User()->name_first." ".Auth::User()->name_middle." ".Auth::User()->name_last }}
            <small>Member since {{ Auth::User()->created_at->format('M Y') }}</small>
        </p>
    </li>
    <!-- Menu Body -->
    <li class="user-body">
        <div class="col-xs-4 text-center">
            <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
            <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
            <a href="#">Friends</a>
        </div>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
        <div class="pull-left">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
        </div>
        <div class="pull-right">
            <a href="{{ URL::route('auth.logout') }}" class="btn btn-default btn-flat">Sign out</a>
        </div>
    </li>
</ul>