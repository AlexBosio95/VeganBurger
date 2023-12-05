@extends('layouts.app')

@section('content')
    <div class="container my-4 position-relative">
        <h1 class="big-title">Part View</h1>
        <div class="box-card mt-4">
            
            <div class="row">
                
                <div class="col-md-6 mob-mood">
                    <div class="visible-print m-4">
                        {!! QrCode::size(150)->generate(route('admin.parts.show', ['part' => $part->part_number])); !!}
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-12">
                    @if ($part->image)
                        <img
                            src="{{asset('storage/' . $part->image)}}"
                            alt=""
                            class="preview-image-view"
                        />
                    @else
                        <div class="preview-image-view position-relative"><i class="bi bi-image-fill fs-1 icon-image"></i></div>
                    @endif
                </div>

            </div>

            <div class="box-code">
                <h1 class="title m-0">{{$part->part_number}}</h1>
            </div>

            <div class="row m-3 gy-2">

                <div class="col-12 mt-4 mb-0">
                    <h1 class="title mt-2">{!! DNS1D::getBarcodeHTML($part->part_number, 'C128', 1.8, 72) !!}</h1>
                </div>
    
                <div class="col-7 desc-box mt-2">
                    <p class="m-0 opacity-75">{{$part->name}}</p>
                    <p class="desc-text">{{$part->description}}</p>
                </div>

                <div class="col-5">
                    <div class="d-flex justify-content-end align-items-end h-100">
                        <h1 class="title-big">{{$part->quantity}}</h1>
                        <pre> /pz</pre>
                    </div>
                </div>

            </div>
        </div>
        <div class="capsule-box">
            <div class="d-flex align-items-center">
                <div class="tag-box orange"></div>
                <p class="mb-0 ms-1">{{$part->category->name}}</p>
            </div>

            <div class="d-flex align-items-center ms-3">
                <div class="tag-box azzurro-full"></div>
                <p class="mb-0 ms-1">{{$part->manufacturer->name}}</p>
            </div>
        </div>

        <a href="{{ route('admin.parts.index') }}" class="button-back"><i class="bi bi-arrow-left icon-back"></i></a>

    </div>

@endsection