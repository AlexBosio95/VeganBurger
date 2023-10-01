@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="big-title">New Part</h1>

    <form enctype="multipart/form-data" class="new-item-create mt-4" action="{{route('admin.parts.store')}}" method="POST">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('part_number') is-invalid @enderror" placeholder="code" name="part_number" value="{{old('part_number')}}">
                    @error('part_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name" value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="input-group mb-3">
            <textarea placeholder="Description" class="form-control @error('description') is-invalid @enderror" aria-label="With textarea" name="description">{{old('description')}}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row align-items-start">
            <div class="col-6">
                <label for="quantity" class="form-label">Quantity</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="0-9999" name="quantity" value="{{old('quantity')}}">
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
                    <input type="text" class="form-control @error('location') is-invalid @enderror" placeholder="A-3B-23" name="location" value="{{old('location')}}">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <label for="price" class="form-label">Price</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="1.00 €" name="price" value="{{old('price')}}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="image">Images</label>
                <input type="file" class="form-control @error ('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="d-flex align-items-center">
            <button type="submit" class="button-create blue-default">Crea nuovo prodotto</button>
        </div>
    </form>
    
    
</div>
@endsection