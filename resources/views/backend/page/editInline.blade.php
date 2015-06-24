@extends('frontend.page')
@section('title','Admin - Page - Edit')
@section('subtitle',$page->slug)
@section('css')
    {!! HTML::style( asset('assets/vendor/jquery-ui/themes/base/jquery-ui.css') ) !!}
@stop
@section('content')
    <div id="contentarea">
        @parent
    </div>
@stop
@section('javascript')
    @include('vendor.contentBuilder')
    @include('backend.page._partials.editinline-menu')
    @include('backend.page._partials.order-js')
@endsection