@extends('backend')
@section('title','Admin - User - Index')
@section('content')
    <p>Admin - User - Index</p>
    <p>This is where stats and other data will go</p>
    @foreach($history as $item)
        <li>
            @if($item->userResponsible())
                {{ $item->userResponsible()->name_first }}
            @else
                Guest
            @endif
            changed {{ $item->fieldName() }} from {{ $item->oldValue() }} to {{ $item->newValue() }}
            on Role {{$item->historyOf()->name}}
        </li>
    @endforeach
@endsection
