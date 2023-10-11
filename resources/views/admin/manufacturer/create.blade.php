@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="big-title">New Supplier</h1>

    <form class="new-item-create mt-4" action="{{route('admin.manufacturers.store')}}" method="POST">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('country') is-invalid @enderror" placeholder="Country" name="country" value="{{old('country')}}">
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('contact_email') is-invalid @enderror" placeholder="Email" name="contact_email" value="{{old('contact_email')}}">
                    @error('contact_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone number" name="phone_number" value="{{old('phone_number')}}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('website') is-invalid @enderror" placeholder="Website" name="website" value="{{old('website')}}">
                    @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('contact_person') is-invalid @enderror" placeholder="Contact person" name="contact_person" value="{{old('contact_person')}}">
                    @error('contact_person')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-10">
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="address" name="address" value="{{old('address')}}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="button-create blue-default">Create Supplier</button>
        </div>
    </form>
    
    
</div>
@endsection