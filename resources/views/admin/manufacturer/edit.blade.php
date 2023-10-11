@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="big-title"> Supplier Update </h1>
    <form class="new-item-create mt-4" action="{{route('admin.manufacturers.update', ['manufacturer' => $manufacturer])}}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6">
                <label class="opacity-50" for="name">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name" value="{{old('name', $manufacturer->name)}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label class="opacity-50" for="country">Country</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('country') is-invalid @enderror" placeholder="country" name="country" value="{{old('country', $manufacturer->country)}}">
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <label class="opacity-50" for="contact_email">Email</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('contact_email') is-invalid @enderror" placeholder="contact_email" name="contact_email" value="{{old('contact_email', $manufacturer->contact_email)}}">
                    @error('contact_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <label class="opacity-50" for="phone_number">Phone</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="phone_number" name="phone_number" value="{{old('phone_number', $manufacturer->phone_number)}}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <label class="opacity-50" for="website">Website</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('website') is-invalid @enderror" placeholder="website" name="website" value="{{old('website', $manufacturer->website)}}">
                    @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label class="opacity-50" for="contact_person">Contact</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('contact_person') is-invalid @enderror" placeholder="contact_person" name="contact_person" value="{{old('contact_person', $manufacturer->contact_person)}}">
                    @error('contact_person')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-10">
                <label class="opacity-50" for="address">Address</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="address" name="address" value="{{old('address', $manufacturer->address)}}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        

        <div class="d-flex align-items-center">
            <button type="submit" class="button-create blue-default">Update Supplier</button>
        </div>
    </form>
    
    
</div>

@endsection