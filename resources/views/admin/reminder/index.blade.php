@extends('layouts.app')

@section('content')

    <div class="container">

        @if (session('status'))
            <div class="alert alert-danger mt-3">
                {{ session('status') }}
            </div>
		@endif
		
        @if (session('create'))
            <div class="alert alert-success mt-3">
                {{ session('create') }}
            </div>
        @endif

        @if (session('update'))
            <div class="alert alert-success mt-3">
                {{ session('update') }}
            </div>
        @endif

        <a class="btn btn-primary" href="{{route('admin.reminder.create')}}">New Reminder</a>

        <table class="table table-light table-striped">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                
                @foreach ($reminders as $reminder)
                <tr>
                    <th scope="row">{{$reminder->id}}</th>
                    <td>{{$reminder->title}}</td>
                    <td>{{$reminder->description}}</td>
                    <td>{{$reminder->status}}</td>
                    <td class="d-flex justify-content-center">
                        <a class="btn btn-success mx-2" href="{{route('admin.reminder.show', ['reminder' => $reminder])}}">Preview</a>
                        <a class="btn btn-warning mx-2" href="{{route('admin.reminder.edit', ['reminder' => $reminder])}}">Edit</a>
                        <form action="{{route('admin.reminder.destroy', ['reminder' => $reminder])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-2">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection