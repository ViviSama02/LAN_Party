@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <!-- Changement de la chaîne de catactère "Dashboard" pour une localisation (permet la traduction) -->

                    <div class="card-header">@lang('Dashboard')</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @lang('You are logged in!')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
