@extends('layouts.app')

@section('content')
    <trip-list
        api-route="{{ route('api-trip') }}"
        api-token="{{ Auth::user()->api_token }}"
    ></trip-list>
@endsection