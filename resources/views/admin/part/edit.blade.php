@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="big-title"> {{$part->part_number}} </h1>

    <form action="{{route('admin.parts.deleteImage', ['part' => $part])}}" method="POST" id="deleteImageForm" class="d-none">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">DELETE IMAGE</button>
    </form>

    <form enctype="multipart/form-data" class="new-item-create mt-4" action="{{route('admin.parts.update', ['part' => $part])}}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name" value="{{old('name', $part->name)}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="input-group mb-3">
            <textarea placeholder="Description" class="form-control @error('description') is-invalid @enderror" aria-label="With textarea" name="description">{{ old('description', $part->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row align-items-start">
            <div class="col-6">
                <label for="quantity" class="form-label">Quantity</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="0-9999" name="quantity" value="{{old('quantity', $part->quantity)}}">
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <label for="category" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" name="category_id">
                    @foreach($categories as $categoryId => $categoryName)
                        <option {{(old('category_id') == $categoryId) ? 'selected' : ''}} value="{{ $categoryId }}">{{ $categoryName }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-4">
                <label for="manufacturer" class="form-label">Manufacturer</label>
                <select class="form-select @error('manufacturer_id') is-invalid @enderror" aria-label="Default select example" name="manufacturer_id">
                    @foreach($manufacturers as $manufacturerId => $manufacturerName)
                        <option {{(old('manufacturer_id') == $manufacturerId) ? 'selected' : ''}} value="{{ $manufacturerId }}">{{ $manufacturerName }}</option>
                    @endforeach
                </select>
                @error('manufacturer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-4">
                <label for="location" class="form-label">Location</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('location') is-invalid @enderror" placeholder="A-3B-23" name="location" value="{{old('location', $part->location)}}">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <label for="price" class="form-label">Price</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="1.00 €" name="price" value="{{old('price', $part->price)}}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="img-container">
            @if ($part->image)
                <img src="{{asset('storage/' . $part->image)}}" class="img-edit-view"/>
                <a href="#" class="delete-button" onclick="event.preventDefault(); document.getElementById('deleteImageForm').submit();"><i class="bi bi-trash-fill fs-4 m-0"></i></a>
            @else
                <p>No loaded image!</p>

                <div class="form-group">
                    <label for="image">Images</label>
                    <input type="file" class="form-control @error ('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            @endif
        </div>

        

        <div class="d-flex align-items-center">
            <button type="submit" class="button-create blue-default">Aggiorna prodotto</button>
        </div>
    </form>
    
    
</div>

@endsection