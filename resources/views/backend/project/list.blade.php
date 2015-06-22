@extends('backend')
@section('title','Admin - Project - Listing')
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
                @foreach($projects as $project)
                    <tr id="project-{{$project->id}}-tr">
                        <td>{{$project->id}}</td>
                        <td id="project-Title-{{$project->id}}">{{$project->title}}</td>
                        <td id="project-Description-{{$project->id}}">{{$project->description}}</td>
                        <td id="project-URL-{{$project->id}}"></td>
                        <td>
                            @include('backend.project._partials.edit-btn')
                            @include('backend.project._partials.delete-btn')
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
                {!! $projects->render() !!}
            </ul>
        </div>
    </div>
@stop
@section('javascript')
    @include('backend.project._partials.delete-js')
@stop