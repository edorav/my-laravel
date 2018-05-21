@extends('layouts.app')

@section('content')

<new-trip-component
    csrf-token="{{ csrf_token() }}"
    submit-route="{{ route('api-store-trip') }}"
    friendship-route="{{ route('api-get-friendships-list-by-search') }}"
    api-token="{{ Auth::user()->api_token }}"
></new-trip-component>

@endsection