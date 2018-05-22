@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <trip-list
                api-route="{{ route('api-trip') }}"
                api-token="{{ Auth::user()->api_token }}"
            ></trip-list>
        </div>
    </div>
</div>
@endsection