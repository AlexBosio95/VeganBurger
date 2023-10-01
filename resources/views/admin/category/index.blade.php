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
    <h1 class="big-title">Category</h1>
    <div class="mb-4 custom-search-bar">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="d-flex">
            @csrf
            <div class="input-group">
                <input type="text" name="search" class="form-control custom-input" placeholder="Search..." value="{{ old('search', $search) }}">
                <button type="submit" class="custom-button">
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
    @if (count($categories) > 0)
        <div class="view-table">
            <table class="table table-warning table-striped align-middle">
                    <tbody class="body">
                        @foreach ($categories as $category)
                        <tr>
                            <td>
                                <div>
                                    <p class="fw-bold ms-3 my-0">{{$category->name}}</p>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <p class="fw-bold my-0">{{$category->description}}</p>
                                </div>
                            </td>

                            <td >
                                <div class="d-flex justify-content-center align-items-center">
                                    <a class="button-action" href="{{route('admin.categories.show', ['category' => $category])}}">
                                        <i class="bi bi-arrow-right-square-fill"></i>
                                    </a>
                                    <a class="ms-3 me-2 button-action" href="{{route('admin.categories.edit', ['category' => $category])}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form class="button-none" action="{{route('admin.categories.destroy', ['category' => $category])}}" method="POST">
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
