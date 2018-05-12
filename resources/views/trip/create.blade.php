@extends('layouts.app')

@section('content')

<new-trip-component
    csrf-token="{{ csrf_token() }}"
    submit-route="{{ route('store-friendship') }}"
    friendship-route="{{ route('get-friendships-list-by-search') }}"
></new-trip-component>

@endsection
