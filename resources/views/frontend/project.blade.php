@extends('frontend')
@section('title','Projects')@endsection
@section('css')
    <style>
        #countdown-wrap {
            width: 100%;
            height: auto;
            //border: 1px solid black;
            padding: 20px;
            font-family: arial;
        }

        #goal {
            font-size: 48px;
            width: 100%;
        }

        #glass {
            width: 100%;
            height: 20px;
            background: #c7c7c7;
            border-radius: 10px;
            overflow: hidden;
        }

        #progress {
            width: {{($project->progress/$project->goal)*100}}%;
            height: 20px;
            background: #AB2430;
            //border-radius: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <img class="img-responsive img-rounded" src="http://placehold.it/900x350" alt="">
        </div>
        <!-- /.col-md-8 -->
        <div class="col-md-4">
            <h1>{{$project->title}}</h1>

            <p>{{$project->description}}</p>

            <a class="btn btn-primary btn-lg" href="#">Fund Project!</a>
        </div>
        <!-- /.col-md-4 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id=countdown-wrap>
                <div id="goal"><span class="pull-left">${{number_format($project->progress,2)}}</span> <span class="pull-right">${{number_format($project->goal,2)}}</span></div>
                <div id="glass">
                    <div id="progress">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="contentarea">
                {!! $project->content !!}
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    @include('vendor.contentBuilder')
@endsection