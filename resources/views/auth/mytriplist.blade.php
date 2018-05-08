@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
  
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Trips</div>

                <div class="card-body">
                    <ol>
                    @foreach($loggedUserTrips as $trip)
                        <li>{{ $trip->label }}</li>
                    @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection