@extends('lans.show')

@section('show')
    <div class="row">
        <div class="col">
            <ul class="list-group m-3">
                @foreach($lan->users as $user)
                    <li class="list-group-item">{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection