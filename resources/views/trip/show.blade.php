@extends('layouts.app')

@section('content')

<new-trip-component
    csrf-token="{{ csrf_token() }}"
    submit-route="{{ route('api-store-trip') }}"
    friendship-route="{{ route('api-get-friendships-list-by-search') }}"
    api-token="{{ Auth::user()->api_token }}"
    :trip-parent="{{ $trip }}"
></new-trip-component>

@endsection