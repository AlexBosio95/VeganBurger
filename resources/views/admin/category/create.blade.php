@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="big-title">New Category</h1>

    <form enctype="multipart/form-data" class="new-item-create mt-4" action="{{route('admin.categories.store')}}" method="POST">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="code" name="name" value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="input-group mb-3">
                <textarea placeholder="Description" class="form-control @error('description') is-invalid @enderror" aria-label="With textarea" name="description">{{old('description')}}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        </div>
        <div class="d-flex align-items-center">
            <button type="submit" class="button-create blue-default">Crea nuova categoria</button>
        </div>
    </form>
    
    
</div>
@endsection