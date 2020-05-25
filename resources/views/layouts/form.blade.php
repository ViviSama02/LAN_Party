{{-- Hériter de ce layout pour obtenir un affichage de formulaire --}}

@extends('layouts.app')

@section('content')
    <div class="bg-primary text-light">
        <div class="container">
            <div class="row">
                <h1 class="title centre">
                    @yield('label', 'Description du formulaire')
                </h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card mt-4 shadow">
                    <div class="card-body">
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection