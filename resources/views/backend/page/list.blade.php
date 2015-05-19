@extends('backend')
@section('title','Admin - Page - Listing')
@section('content')
    <div class="box">
        <div class="box-body table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="user-table">
                @foreach($pages as $page)
                    <tr id="Page-{{$page->id}}-tr">
                        <td>{{$page->id}}</td>
                        <td id="Page-Title-{{$page->id}}">{{$page->title}}</td>
                        <td id="Page-Description-{{$page->id}}">{{$page->description}}</td>
                        <td id="Page-URL-{{$page->id}}">{{$page->getURLAttribute()}}</td>
                        <td>
                            @include('backend.page._partials.edit-btn')
                            @include('backend.page._partials.delete-btn')
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <div class="pull-left">

            </div>
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $pages->render() !!}
            </ul>
        </div>
    </div>
@stop
@section('javascript')
    @include('backend.page._partials.delete-js')
@stop