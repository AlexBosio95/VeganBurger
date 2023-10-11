@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="big-title"> Category Update </h1>
    <form class="new-item-create mt-4" action="{{route('admin.categories.update', ['category' => $category])}}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name" value="{{old('name', $category->name)}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="input-group mb-3">
            <textarea placeholder="Description" class="form-control @error('description') is-invalid @enderror" aria-label="With textarea" name="description">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="button-create blue-default">Aggiorna categoria</button>
        </div>
    </form>
    
    
</div>

@endsection