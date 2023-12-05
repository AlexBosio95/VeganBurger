@extends('layouts.app')

@section('content')

<div class="container my-4 pe-md-5 pe-sm-1">

    <div class="position-relative">
        {{-- Allert di avviso --}}
        @if (session('status'))
            <a class="status bg-danger" id="statusElement" onclick="hideElement(this)">
                {{ session('status') }} <i class="bi bi-x-lg"></i>
            </a>
        @endif
    
        @if (session('create'))
            <a class="status bg-success" id="createElement" onclick="hideElement(this)">
                {{ session('create') }} <i class="bi bi-x-lg"></i>
            </a>
        @endif
    
        @if (session('update'))
            <a class="status bg-success" id="updateElement" onclick="hideElement(this)">
                {{ session('update') }} <i class="bi bi-x-lg"></i>
            </a>
        @endif
    </div>

    {{-- Barra di ricerca --}}
    <h1 class="big-title">OrdersItems</h1>
    <div class="my-4 std-search-bar">
        <form action="{{ route('admin.orderitems.index') }}" method="GET" class="d-flex">
            @csrf
            <div class="input-group">
                <input type="text" name="search" class="form-control std-input" placeholder="Search..." value="{{ old('search', $search) }}">
                <button type="submit" class="std-button">
                    <lord-icon
                        src="https://cdn.lordicon.com/rlizirgt.json"
                        style="width:25px;height:25px"
                        trigger="hover"
                        colors="primary:#ffffff"
                        state="hover">
                    </lord-icon>
                </button>
            </div>
        </form>
    </div>

    {{-- Elenco parti --}}
    @if (count($orderItems) > 0)
        <div class="view-table">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">IMG</th>
                        <th class="text-center" scope="col">Code</th>
                        <th class="text-center mob-mood" scope="col">Order Number</th>
                        <th class="text-center mob-mood" scope="col">Quantity</th>
                        <th class="text-center mob-mood" scope="col">Price</th>
                        <th class="text-center mob-mood" scope="col">Total Price</th>
                        <th class="text-center" scope="col">Check</th>
                    </tr>
                </thead>
                
                    <tbody class="body">
                        @foreach ($orderItems as $item)
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    @if ($item->part->image)
                                        <img
                                        src="{{asset('storage/' . $item->part->image)}}"
                                        alt=""
                                        class="preview-image"
                                        />
                                    @else
                                        <div class="preview-image position-relative"><i class="bi bi-image-fill icon-image"></i></div>
                                    @endif
                                </div>
                            </td>
                            <td class="fs-5"><p class="text-center mb-0">{{$item->part->part_number}}</p></td>
                            <td class="fs-5 mob-mood"><p class="text-center mb-0">{{$item->order->order_number}}</p></td>
                            <td class="fs-5 mob-mood"><p class="text-center mb-0">{{$item->quantity_ordered}}</p></td>
                            <td class="fs-5 mob-mood"><p class="text-center mb-0">{{$item->unit_price}}</p></td>
                            <td class="fs-5 mob-mood"><p class="text-center mb-0">{{$item->subtotal}}</p></td>
                            
                            <td>
                                
                                <div class="d-flex justify-content-evenly align-items-center">
                                    <form method="POST" action="{{ route('admin.orderitems.changeStatus', ['id' => $item->id]) }}">
                                        @csrf
                                        @method('POST')
                                        @if ($item->completed)
                                            <button class="button-order red" type="submit"><i class="bi bi-x-lg"></i></button>
                                        @else
                                            <button class="button-order green-strong" type="submit"><i class="bi bi-check-lg"></i></button>
                                        @endif
                                    </form>
                                    {{-- <a class="button-order lime"><i class="bi bi-hammer"></i></a>
                                    <a class="button-order green-strong d-none"><i class="bi bi-check-lg"></i></a>
                                    <a class="button-order red d-none"><i class="bi bi-x-lg"></i></a> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
        </div>
    
    @else
        <p>Nessun prodotto</p>
    @endif

    </div>

@endsection
