@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                
            @foreach ($list as $agency)
                <div class="card my-3">
                    <p>Agency {{ $agency->id }}</p>
                    <p>Agency {{ $agency->name }}</p>
                    <p>Agency {{ $agency->city }}</p>
                </div>
            @endforeach

            
        </div>
    </div>
</div>
@endsection
