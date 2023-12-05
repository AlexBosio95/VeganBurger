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
    <h1 class="big-title">Orders</h1>
    <div class="my-4 std-search-bar">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex">
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
    @if (count($orders) > 0)
        <div class="view-table">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th class="ps-4" scope="col">Number order</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center mob-mood" scope="col">Arrival date</th>
                        <th class="text-center mob-mood" scope="col">Order date</th>
                    </tr>
                </thead>

                <tbody class="body">
                    @foreach ($orders as $order)
                    <tr>
                        <td class="fs-5 ps-4">{{$order->order_number}}</td>
                        <td class="fs-5 mob-mood"> <p class="
                            @if ($order->status == 'completed')
                                green-strong 
                                @else
                                lime
                            @endif capsule text-white w-75 m-auto my-2">{{$order->status}}</p></td>
                            {{-- Mobile version --}}
                        <td class="fs-5 only-mobile"> <p class="
                            @if ($order->status == 'completed')
                                green-strong 
                                @else
                                lime
                            @endif circle-status m-auto my-2"></p></td>
                        
                        <td class="fs-5 mob-mood"><p class="d-flex justify-content-evenly align-items-center mb-0">{{$order->arrival_date}}</p></td>
                        <td class="fs-5 mob-mood"><p class="d-flex justify-content-evenly align-items-center mb-0">{{$order->order_date}}</p></td>
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
