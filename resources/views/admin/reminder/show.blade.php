@extends('layouts.app')

@section('content')

    <div class="container">

        <a class="btn btn-primary my-4" href="{{route('admin.reminder.index')}}">< Back</a>

        <h2 class="text-center">{{$reminder->title}}</h2>

        <div class="card">
            <div class="card-header">
                {{$reminder->slug}}
            </div>
            <div class="card-body">
                <p class="card-text">{{$reminder->title}}</p>
            </div>
        </div>    
    </div>

@endsection