<ul class="nav navbar-nav  pull-right">
    {!! Page::navigation() !!}
    @permission('portal')
        <li> <a class="page-scroll"  href="{{URL::route('portal.dashboard')}}">Portal</a></li>
    @endpermission
    @role('root|admin','one')
        <li> <a class="page-scroll"  href="{{URL::route('admin.dashboard')}}">Admin</a></li>
    @endrole
    @if(Auth::check())
        <li class="nav-item nav-item-cta"> <a class="btn btn-cta btn-cta-secondary last navbar-btn" href="{{URL::route('auth.logout')}}">Log Out</a></li>
    @else
        <li class="nav-item nav-item-cta"> <a class="btn btn-cta btn-cta-secondary last navbar-btn" href="{{URL::route('auth.login')}}">Login</a></li>
        <li class="nav-item nav-item-cta"> <a class="btn btn-cta btn-cta-secondary last navbar-btn" href="{{URL::route('auth.register')}}">Register</a></li>
    @endif
</ul>