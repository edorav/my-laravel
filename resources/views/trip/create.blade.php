@extends('layouts.app')

@section('content')

<new-trip-component
    csrf-token="{{ csrf_token() }}"
    submit-route="{{ route('store-friendship') }}"
></new-trip-component>

@endsection
