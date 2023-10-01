@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{route('admin.reminder.update', ['reminder' => $reminder])}}" method="POST">

            @csrf
            @method('PUT')
            
            <label for="title" class="form-label">Title</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" value="{{old('title', $reminder->title)}}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <label for="description" class="form-label">Description</label>
            <div class="input-group mb-3">
                <textarea placeholder="Post description" class="form-control @error('description') is-invalid @enderror" aria-label="With textarea" name="description">{{old('description', $reminder->description)}}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label for="status" class="form-label">Status</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('status') is-invalid @enderror" placeholder="status" name="status" value="{{old('status', $reminder->status)}}">
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>

@endsection