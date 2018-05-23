@extends('layouts.app')

@section('content')

<new-trip-component
    csrf-token="{{ csrf_token() }}"
    friendship-route="{{ route('api-get-friendships-list-by-search') }}"
    store-cities-route="{{ route('api-store-cities') }}"
    store-users-route="{{ route('api-store-users') }}"
    api-token="{{ Auth::user()->api_token }}"
    :trip-parent="{{ $trip }}"
></new-trip-component>

@endsection