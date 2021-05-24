@extends('layouts.app')

@section('content')

    <h1>Tasks per category</h1>

    <p><a href="/">Home</a></p>

    <ul>
        @foreach( $cats as $cat )
            <li>
                {{$cat->name}}
                <ul>
                    @foreach( $cat->tasks as $task)
                        <li>{{$task->name}}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endsection