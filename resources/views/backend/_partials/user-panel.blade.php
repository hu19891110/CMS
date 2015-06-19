<div class="pull-left image">
    <img src="/assets/vendor/admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
</div>
<div class="pull-left info">
    <p>{!! Auth::User()->name_first." ".Auth::User()->name_middle." ".Auth::User()->name_last !!}</p>
    <!-- Status -->
    <a href="{{URL::route('auth.logout')}}"><i class="fa fa-circle text-success"></i> Online</a>
</div>