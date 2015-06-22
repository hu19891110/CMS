@extends('frontend.page')
@section('title','Admin - Page - Edit')
@section('subtitle',$page->slug)
@section('css')
    {!! HTML::style( asset('/assets/vendor/ContentBuilder/scripts/contentbuilder.css') ) !!}
    {!! HTML::style( asset('/assets/vendor/ContentBuilder/assets/minimalist-basic/content.css') ) !!}
    {!! HTML::style( asset('assets/vendor/jquery-ui/themes/base/jquery-ui.css') ) !!}
    <style>
        #parent{
            position:fixed;
            bottom:0px;
            width:100%;
            z-index: 10000;
        }
        #child{
            background-color: #000000;
            width: auto;
            height: 50px;
            text-align: center;
        }
        #rte-toolbar{
            z-index: 10000;
        }
    </style>
@stop
@section('content')
    <div id="contentarea">
        @parent
    </div>
@stop
@section('javascript')
    @include('backend.page._partials.editinline-menu')
@endsection