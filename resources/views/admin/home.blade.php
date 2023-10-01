@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-start gy-5">
        <div class="col-3">
            <a class="square-button lime" href="{{route('admin.parts.index')}}">
                <div class="row">
                    <div class="col-12 text-start">
                        <h2 class="mb-0 fw-bold">Product</h2>
                    </div>
                    <div class="col-3 text-start">
                        <div class="d-flex align-items-end">
                            <h1 class="d-inline">{{ count($parts) }}</h1>
                            <p class="ps-2">items</p>
                        </div>
                    </div>
                    <div class="col-12 text-start">
                        <p>Prodotti attualmente stoccati nel magazzino, clicca per gestire i tuoi prodotti</p>
                    </div>
                </div>
                <div class="icon"><i class="bi bi-box-seam-fill"></i></div>
            </a>
        </div>

        <div class="col-3">
            <a class="square-button orange" href="{{route('admin.parts.index')}}">
                <div class="row">
                    <div class="col-12 text-start">
                        <h2 class="mb-0 fw-bold">Category</h2>
                    </div>
                    <div class="col-3 text-start">
                        <div class="d-flex align-items-end">
                            <h1 class="d-inline">{{ count($categories) }}</h1>
                            <p class="ps-2">items</p>
                        </div>
                    </div>
                    <div class="col-12 text-start">
                        <p>Categorie dei prodotti attualmente stoccati nel magazzino, clicca per gestirle</p>
                    </div>
                </div>
                <div class="icon"><i class="bi bi-tags-fill"></i></div>
            </a>
        </div>

        <div class="col-3">
            <a class="square-button azzurro" href="{{route('admin.parts.index')}}">
                <div class="row">
                    <div class="col-12 text-start">
                        <h2 class="mb-0 fw-bold">Suppliers</h2>
                    </div>
                    <div class="col-3 text-start">
                        <div class="d-flex align-items-end">
                            <h1 class="d-inline">{{ count($manufacturers) }}</h1>
                            <p class="ps-2">items</p>
                        </div>
                    </div>
                    <div class="col-12 text-start">
                        <p>Gestione dei tuoi fornitori per la merce del tuo magazzino, clicca per gestirli</p>
                    </div>
                </div>
                <div class="icon"><i class="bi bi-buildings-fill"></i></div>
            </a>
        </div>

    </div>
</div>
@endsection
