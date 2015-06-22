<ul class="nav navbar-nav  pull-right">
    {!! Page::navigation() !!}
    @role('member')
        <li> <a class="page-scroll"  href="{{URL::route('portal.dashboard')}}">Portal</a></li>
    @endrole
    @role('root|admin|admin.*')
        <li> <a class="page-scroll"  href="{{URL::route('admin.dashboard')}}">Admin</a></li>
    @endrole
    @if(Auth::check())
        <li class="nav-item nav-item-cta"> <a class="btn btn-cta btn-cta-secondary last navbar-btn" href="{{URL::route('auth.logout')}}">Log Out</a></li>
    @else
        <li class="nav-item nav-item-cta"> <a class="btn btn-cta btn-cta-secondary last navbar-btn" href="{{URL::route('auth.login')}}">Login</a></li>
        @if(Config::get('publicSignup'))
            <li class="nav-item nav-item-cta"> <a class="btn btn-cta btn-cta-secondary last navbar-btn" href="{{URL::route('auth.register')}}">Register</a></li>
        @endif
    @endif
</ul>