@extends('layouts.app')

@section('content')

<div class="container my-4 pe-5">

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
    <h1 class="big-title">Supplier</h1>
    <div class="my-4 std-search-bar">
        <form action="{{ route('admin.manufacturers.index') }}" method="GET" class="d-flex">
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
    @if (count($manufacturers) > 0)
        <div class="view-table">
            <table class="table table-striped align-middle">
                    <tbody class="body">
                        @foreach ($manufacturers as $manufacturer)
                        <tr>
                            <td>
                                <div>
                                    <p class="fw-bold ms-3 my-0">{{$manufacturer->name}}</p>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <p class="fw-bold my-0">{{$manufacturer->country}}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="fw-bold my-0">{{$manufacturer->contact_email}}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="fw-bold my-0">{{$manufacturer->phone_number}}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="fw-bold my-0">{{$manufacturer->address}}</p>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <p class="fw-bold my-0">{{$manufacturer->website}}</p>
                                </div>
                            </td>

                            <td >
                                <div class="d-flex justify-content-center align-items-center">
                                    <a class="ms-3 me-2 button-action" href="{{route('admin.manufacturers.edit', ['manufacturer' => $manufacturer])}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form class="button-none" action="{{route('admin.manufacturers.destroy', ['manufacturer' => $manufacturer])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button-none">
                                            <lord-icon role="button"
                                            src="https://cdn.lordicon.com/jmkrnisz.json"
                                            colors= "primary:#FF0000"
                                            trigger="hover"
                                            style="width:30px;height:30px">
                                        </lord-icon>
                                        </button>
                                    </form>
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
